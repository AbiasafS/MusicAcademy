<x-admin-layout :breadcrumbs="[
    ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
    ['name' => 'Usuarios', 'href' => route('admin.users.index')],
]">

    <x-slot name="action">
        <a href="{{ route('admin.users.create') }}"
            class="px-3 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
            <i class="fa-solid fa-plus"></i> Nuevo
        </a>
    </x-slot>

    @livewire('admin.datatables.user-table')

</x-admin-layout>
