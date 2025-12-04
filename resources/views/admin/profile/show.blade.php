<x-admin-layout 
    :title="'Perfil'" 
    :breadcrumbs="[
        ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
        ['name' => 'Perfil']
    ]">

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

        {{-- Actualizar información del perfil --}}
        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
            @livewire('profile.update-profile-information-form')

            <x-section-border />
        @endif

        {{-- Cambiar contraseña --}}
        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
            <div class="mt-10 sm:mt-0">
                @livewire('profile.update-password-form')
            </div>

            <x-section-border />
        @endif

        {{-- Autenticación de dos factores --}}
        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
            <div class="mt-10 sm:mt-0">
                @livewire('profile.two-factor-authentication-form')
            </div>

            <x-section-border />
        @endif

        {{-- Cerrar otras sesiones --}}
        <div class="mt-10 sm:mt-0">
            @livewire('profile.logout-other-browser-sessions-form')
        </div>

        {{-- Eliminar usuario --}}
        @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
            <x-section-border />

            <div class="mt-10 sm:mt-0">
                @livewire('profile.delete-user-form')
            </div>
        @endif

    </div>

</x-admin-layout>
