<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Cubiculo;
use App\Models\Ubicacione;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    /**
     * Obtener áreas por departamento.
     *
     * @param int $id_departamento
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAreasByDepartamento($id_departamento)
    {
        $areas = Area::where('id_departamento', $id_departamento)->get();
        return response()->json($areas);
    }

    /**
     * Obtener ubicaciones por área.
     *
     * @param int $id_area
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUbicacionesByArea($id_area)
    {
        $ubicaciones = Ubicacione::where('id_area', $id_area)->get();
        return response()->json($ubicaciones);
    }

    /**
     * Obtener cubículos por ubicación.
     *
     * @param int $id_ubicacion
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCubiculosByUbicacion($id_ubicacion)
    {
        $cubiculos = Cubiculo::where('id_ubicacion', $id_ubicacion)->get();
        return response()->json($cubiculos);
    }
}
