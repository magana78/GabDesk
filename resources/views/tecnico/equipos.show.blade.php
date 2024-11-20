<form action="{{ route('tecnico.cambiarEstadoEquipo', $equipo->id_equipo) }}" method="POST" class="w-full text-center">
    @csrf
    @method('PUT')
    <label for="estado_equipo" class="text-gray-700 dark:text-gray-300">Cambiar Estado:</label>
    <select name="estado_equipo" id="estado_equipo" class="w-full mt-2 p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-300">
        <option value="operativo" {{ $equipo->estado_equipo == 'operativo' ? 'selected' : '' }}>Operativo</option>
        <option value="en reparación" {{ $equipo->estado_equipo == 'en reparación' ? 'selected' : '' }}>En reparación</option>
        <option value="fuera de servicio" {{ $equipo->estado_equipo == 'fuera de servicio' ? 'selected' : '' }}>Fuera de servicio</option>
    </select>
    <button type="submit" class="mt-4 w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 rounded-lg transition duration-200 text-sm">
        Actualizar Estado
    </button>
</form>
