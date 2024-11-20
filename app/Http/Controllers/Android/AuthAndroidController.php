<?php

namespace App\Http\Controllers\Android;

use App\Models\Estadosticket;
use App\Models\Evidenciaticket;
use App\Models\Imagenesequipo;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Equipo;
use App\Models\Ticket;
use App\Http\Controllers\Controller;


class AuthAndroidController extends Controller
{
    // Método de autenticación básica
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Verifica si el usuario puede iniciar sesión
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Usuario::with([
                'departamento',
                'cubiculo.ubicacione.area',
                'equipos.dispositivos.accesorios',
                'equipos.imagenes'
            ])->where('id_usuario', Auth::id())->first();

            return response()->json(['success' => true, 'user' => $user]);
        }

        // Respuesta si las credenciales son inválidas
        return response()->json(['success' => false, 'message' => 'Credenciales inválidas.']);
    }

    // Método para obtener los equipos del usuario, junto con dispositivos y accesorios
    public function getEquiposPorArea($areaId)
{
    $equipos = Equipo::with([
        'usuarios' => function ($query) {
            $query->with([
                'departamento',                        // Trae el departamento del usuario
                'cubiculo' => function ($query) {      // Trae el cubículo del usuario
                    $query->with([
                        'ubicacione' => function ($query) { // Trae la ubicación del cubículo
                            $query->with('area');            // Trae el área de la ubicación
                        }
                    ]);
                }
            ]);
        },
        'dispositivos' => function ($query) {
            $query->with('accesorios');                // Trae los accesorios de cada dispositivo
        },
        'imagenes'                                      // Trae las imágenes del equipo
    ])
    ->whereHas('usuarios.cubiculo.ubicacione.area', function ($query) use ($areaId) {
        $query->where('id_area', $areaId);
    })
    ->get();

    return response()->json(['success' => true, 'equipos' => $equipos]);
}

public function getUsuariosPorArea($areaId)
{
    $usuarios = Usuario::with([
        'departamento',
        'cubiculo' => function ($query) {
            $query->with([
                'ubicacione' => function ($query) {
                    $query->with('area');
                }
            ]);
        },
        'equipos.dispositivos.accesorios',
        'equipos.imagenes'
    ])
    ->whereHas('cubiculo.ubicacione.area', function ($query) use ($areaId) {
        $query->where('id_area', $areaId);
    })
    ->get();

    return response()->json(['success' => true, 'usuarios' => $usuarios]);
}

public function changePassword(Request $request)
{
    // Valida los datos de entrada
    $validatedData = $request->validate([
        'email' => 'required|email',
        'current_password' => 'required',
        'new_password' => 'required|min:8|confirmed',
    ]);

    // Encuentra al usuario por su correo electrónico
    $user = Usuario::where('email', $validatedData['email'])->first();

    // Verifica si el usuario existe
    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'El usuario ingresado no existe.',
        ], 404);
    }

    // Verifica si la contraseña actual es correcta
    if (!\Hash::check($validatedData['current_password'], $user->password)) {
        return response()->json([
            'success' => false,
            'message' => 'La contraseña actual no es correcta.',
        ], 401);
    }

    // Cambia la contraseña por la nueva
    $user->password = \Hash::make($validatedData['new_password']);
    $user->save();

    return response()->json([
        'success' => true,
        'message' => 'Contraseña actualizada correctamente.',
    ]);
}
public function crearTicket(Request $request)
{
    // Validación de los datos de entrada
    $validatedData = $request->validate([
        'titulo' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'estado_ticket' => 'required|in:pendiente,en_proceso,resuelto,cerrado', // Según el enum
        'prioridad' => 'required|in:baja,media,alta',                           // Según el enum
        'id_usuario_reportante' => 'required|exists:usuarios,id_usuario',
        'id_equipo' => 'required|exists:equipo,id_equipo'
    ]);

    try {
        // Crear un nuevo ticket con los datos validados
        $ticket = new Ticket();
        $ticket->titulo = $validatedData['titulo'];
        $ticket->descripcion = $validatedData['descripcion'];
        $ticket->fecha_creacion = now(); // Fecha de creación automática
        $ticket->estado_ticket = $validatedData['estado_ticket'];
        $ticket->prioridad = $validatedData['prioridad'];
        $ticket->id_usuario_reportante = $validatedData['id_usuario_reportante'];
        $ticket->id_equipo = $validatedData['id_equipo'];
        $ticket->save();

        // Crear el estado inicial del ticket en la tabla `estadosticket`
        $estadoTicket = new Estadosticket();
        $estadoTicket->estado = 'pendiente';
        $estadoTicket->fecha_cambio = now();
        $estadoTicket->id_ticket = $ticket->id_ticket;
        $estadoTicket->save();

        // Respuesta de éxito con el ticket en una lista
        return response()->json([
            'success' => true,
            'message' => 'Ticket creado exitosamente.',
            'tickets' => [$ticket],  // Cambiado a una lista de tickets
            'estado_ticket' => $estadoTicket
        ], 201);

    } catch (\Exception $e) {
        // Respuesta en caso de error
        return response()->json([
            'success' => false,
            'message' => 'Ocurrió un error al crear el ticket.',
            'error' => $e->getMessage()
        ], 500);
    }
}



public function subirEvidenciaPorTicket(Request $request, $ticketId)
{
    // Validación de los datos de entrada
    try {
        $request->validate([
            'imagenes' => 'required',
            'imagenes.*' => 'file|image', // Validar cada archivo individualmente
            'descripcion' => 'nullable|string'
        ]);
    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error de validación de los datos de entrada.',
            'errors' => $e->errors()
        ], 422);
    }

    // Encuentra el ticket
    $ticket = Ticket::find($ticketId);
    if (!$ticket) {
        return response()->json([
            'success' => false,
            'message' => 'Ticket no encontrado.',
        ], 404);
    }

    try {
        $evidencias = [];

        // Procesa cada imagen en el array de 'imagenes'
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $archivo) {
                if ($archivo->isValid()) {
                    // Almacena la imagen en storage/app/public/evidencias
                    $path = $archivo->store('evidencias', 'public');
                    $rutaPublica = 'storage/' . $path;

                    // Crea el registro de la evidencia en la base de datos
                    $evidencia = Evidenciaticket::create([
                        'id_ticket' => $ticket->id_ticket,
                        'nombre_archivo' => $archivo->getClientOriginalName(),
                        'extension' => $archivo->getClientOriginalExtension(),
                        'ruta' => $rutaPublica,
                        'fecha_subida' => now(),
                        'descripcion' => $request->input('descripcion', null)
                    ]);

                    $evidencias[] = $evidencia;
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Archivo inválido.',
                    ], 400);
                }
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No se proporcionaron archivos de imagen en el campo "imagenes".',
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Evidencias subidas correctamente.',
            'evidencias' => $evidencias
        ], 201);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Ocurrió un error al subir las evidencias.',
            'error' => $e->getMessage()
        ], 500);
    }
}






public function subirImagenPorEquipo(Request $request, $equipoId)
{
    try {
        // Validación de los datos de entrada para múltiples imágenes
        $request->validate([
            'imagenes.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // Ajuste de tamaño a 5 MB (5120 KB)
        ]);

        // Encuentra el equipo
        $equipo = Equipo::findOrFail($equipoId);

        $imagenesGuardadas = [];
        foreach ($request->file('imagenes') as $archivo) {
            // Almacena cada imagen en storage/app/public/equipos
            $path = $archivo->store('equipos', 'public');
            $rutaPublica = 'storage/' . $path;

            // Crear un nuevo registro en la tabla `imagenesequipo` con los datos de cada imagen
            $imagen = Imagenesequipo::create([
                'id_equipo' => $equipo->id_equipo,
                'nombre_archivo' => $archivo->getClientOriginalName(),
                'extension' => $archivo->getClientOriginalExtension(),
                'ruta' => $rutaPublica,
                'fecha_subida' => now(),
            ]);

            $imagenesGuardadas[] = $imagen;
        }

        // Respuesta de éxito
        return response()->json([
            'success' => true,
            'message' => 'Imágenes subidas correctamente.',
            'imagenes' => $imagenesGuardadas
        ], 201);

    } catch (\Illuminate\Validation\ValidationException $e) {
        // Respuesta personalizada en caso de error de validación
        return response()->json([
            'success' => false,
            'message' => 'Uno o más archivos no son válidos. Asegúrate de enviar solo archivos de imagen (jpeg, png, jpg, gif) de hasta 2MB.',
            'errors' => $e->errors()
        ], 422);
    } catch (\Exception $e) {
        // Respuesta en caso de otros errores
        return response()->json([
            'success' => false,
            'message' => 'Ocurrió un error al subir las imágenes.',
            'error' => $e->getMessage()
        ], 500);
    }
}


public function eliminarImagenesPorEquipo(Request $request, $equipoId)
{
    try {
        // Validación de los datos de entrada
        $validatedData = $request->validate([
            'imagenes' => 'required|array|min:1',          // Debe recibir un array de IDs
            'imagenes.*' => 'integer|exists:imagenesequipo,id_imagen', // Cada ID debe existir en la tabla `imagenesequipo`
        ]);

        // Encuentra el equipo
        $equipo = Equipo::find($equipoId);
        if (!$equipo) {
            return response()->json([
                'success' => false,
                'message' => 'Equipo no encontrado.',
            ], 404);
        }

        // Recuperar las imágenes para el equipo y los IDs especificados en la solicitud
        $imagenes = Imagenesequipo::where('id_equipo', $equipoId)
                                  ->whereIn('id_imagen', $validatedData['imagenes'])
                                  ->get();

        if ($imagenes->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No se encontraron imágenes con los IDs proporcionados para este equipo.',
            ], 404);
        }

        // Elimina cada imagen tanto de la base de datos como del almacenamiento
        foreach ($imagenes as $imagen) {
            // Eliminar el archivo físico si existe
            if (\Storage::disk('public')->exists($imagen->ruta)) {
                \Storage::disk('public')->delete($imagen->ruta);
            }

            // Elimina el registro de la base de datos
            $imagen->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Imágenes eliminadas correctamente.',
        ], 200);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Datos de entrada no válidos.',
            'errors' => $e->errors(),
        ], 422);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Ocurrió un error al intentar eliminar las imágenes.',
            'error' => $e->getMessage(),
        ], 500);
    }
}

public function getTicketsPorArea($areaId)
{
    try {
        // Obtener los tickets que pertenecen a equipos asignados a usuarios en el área especificada
        $tickets = Ticket::with([
            'usuarioReportante.departamento',
            'usuarioReportante.cubiculo.ubicacione.area',
            'usuarioAsignado' => function ($query) {
                $query->with(['departamento', 'cubiculo.ubicacione.area']);
            },
            'equipo.usuarios.cubiculo.ubicacione.area', // Usuario asignado y su ubicación
            'equipo.dispositivos.accesorios',
            'equipo.imagenes',
            'estadostickets',  // Estado actual del ticket
            'evidenciatickets' // Evidencias asociadas
        ])
        ->whereHas('equipo.usuarios.cubiculo.ubicacione.area', function ($query) use ($areaId) {
            $query->where('id_area', $areaId);
        })
        ->get();

        // Si no se encuentran tickets, devuelve una respuesta apropiada
        if ($tickets->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No se encontraron tickets para el área especificada.'
            ], 404);
        }

        // Retornar los tickets en formato JSON
        return response()->json([
            'success' => true,
            'tickets' => $tickets
        ], 200);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Ocurrió un error al obtener los tickets.',
            'error' => $e->getMessage()
        ], 500);
    }
}


public function getEquipoDetalles($equipoId)
{
    // Intenta obtener el equipo junto con los usuarios, dispositivos y accesorios
    $equipo = Equipo::with([
        'usuarios' => function ($query) {
            $query->with(['departamento', 'cubiculo.ubicacione.area']); // Información del usuario
        },
        'dispositivos' => function ($query) {
            $query->with(['accesorios']); // Accesorios de los dispositivos
        },
        'imagenes' // Imágenes del equipo
    ])->find($equipoId);

    // Verifica si se encontró el equipo
    if (!$equipo) {
        return response()->json(['success' => false, 'message' => 'Equipo no encontrado.'], 404);
    }

    // Retorna la información del equipo
    return response()->json(['success' => true, 'equipo' => $equipo]);
}


public function getTicketDetalles($ticketId)
{
    try {
        // Obtener el ticket con todas sus relaciones necesarias
        $ticket = Ticket::with([
            'usuarioReportante' => function ($query) {
                $query->with(['departamento', 'cubiculo.ubicacione.area']);
            },
            'usuarioAsignado' => function ($query) {
                $query->with(['departamento', 'cubiculo.ubicacione.area']);
            },
            'equipo' => function ($query) {
                $query->with([
                    'usuarios' => function ($query) {
                        $query->with(['departamento', 'cubiculo.ubicacione.area']);
                    },
                    'dispositivos' => function ($query) {
                        $query->with('accesorios');
                    },
                    'imagenes'
                ]);
            },
            'estadostickets',  // Estado histórico del ticket
            'evidenciatickets' // Evidencias asociadas al ticket
        ])->find($ticketId);

        // Verificar si se encontró el ticket
        if (!$ticket) {
            return response()->json([
                'success' => false,
                'message' => 'Ticket no encontrado.'
            ], 404);
        }

        // Retornar los detalles del ticket en el formato esperado
        return response()->json([
            'success' => true,
            'ticket' => $ticket
        ], 200);

    } catch (\Exception $e) {
        // Manejo de errores en caso de excepción
        return response()->json([
            'success' => false,
            'message' => 'Ocurrió un error al obtener los detalles del ticket.',
            'error' => $e->getMessage()
        ], 500);
    }
}










}
