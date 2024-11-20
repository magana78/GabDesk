@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Equipos - Estado: {{ ucfirst($estado) }}</h1>

    <!-- Selector de Estado -->
    <div class="mb-4">
        <label for="estado">Filtrar por estado:</label>
        <select id="estado" onchange="location = this.value;">
            <option value="{{ route('equipos.index') }}">Todos</option>
            <option value="{{ route('equipos.estado', 'operativo') }}" {{ $estado == 'operativo' ? 'selected' : '' }}>Operativo</option>
            <option value="{{ route('equipos.estado', 'en reparación') }}" {{ $estado == 'en reparación' ? 'selected' : '' }}>En Reparación</option>
            <option value="{{ route('equipos.estado', 'fuera de servicio') }}" {{ $estado == 'fuera de servicio' ? 'selected' : '' }}>Fuera de Servicio</option>
        </select>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Número de Serie</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($equipos as $equipo)
                <tr>
                    <td>{{ $equipo->id_equipo }}</td>
                    <td>{{ $equipo->nombre_equipo }}</td>
                    <td>{{ $equipo->descripcion }}</td>
                    <td>{{ $equipo->numero_serie }}</td>
                    <td>{{ $equipo->estado_equipo }}</td>
                    <td>
                        <!-- Botón para Cambiar Estado a Operativo -->
                        @if($equipo->estado_equipo != 'operativo')
                            <form action="{{ route('tecnico.cambiarEstadoEquipo', $equipo->id_equipo) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-primary">Cambiar a Operativo</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
