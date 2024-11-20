<section class="flex justify-center items-center">
    <div class="w-full max-w-md bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
        <header class="mb-4">
            <h2 class="text-xl font-semibold text-center text-gray-900 dark:text-gray-100">
                {{ __('Actualizar Contraseña') }}
            </h2>

            <p class="mt-1 text-center text-sm text-gray-600 dark:text-gray-400">
                {{ __('Asegúrate de usar una contraseña larga y aleatoria para mantener tu cuenta segura.') }}
            </p>
        </header>

        <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('put')

            <div>
                <x-input-label for="update_password_current_password" :value="__('Contraseña Actual')" />
                <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="update_password_password" :value="__('Nueva Contraseña')" />
                <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="update_password_password_confirmation" :value="__('Confirmar Contraseña')" />
                <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex justify-center mt-4">
                <x-primary-button onclick="handleSave(event)">{{ __('Guardar') }}</x-primary-button>
            </div>
        </form>

        @if (session('status') === 'password-updated')
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        title: '¡Éxito!',
                        text: 'Contraseña actualizada correctamente.',
                        icon: 'success',
                        confirmButtonText: 'Aceptar',
                        timer: 3000
                    });
                });
            </script>
        @endif
    </div>
</section>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function handleSave(event) {
        event.preventDefault(); // Evitar el envío predeterminado del formulario

        const form = event.target.closest('form');
        Swal.fire({
            title: '¿Estás seguro?',
            text: '¿Deseas guardar los cambios de tu contraseña?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, guardar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit(); // Enviar el formulario
            }
        });
    }
</script>
