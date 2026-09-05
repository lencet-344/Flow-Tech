<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Hemos enviado un código de verificación de 6 dígitos a tu correo electrónico. Por favor ingrésalo para continuar.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('2fa.verify') }}">
        @csrf

        <!-- Código OTP -->
        <div>
            <x-input-label for="code" :value="__('Código de Verificación')" />
            <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" required autofocus autocomplete="one-time-code" />
            <x-input-error :messages="$errors->get('code')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Verificar y Acceder') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>