<x-admin-layout :breadcrumbs="[
    ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
    ['name' => 'Roles y permisos', 'href' => route('admin.roles.index')],
    ['name' => 'Crear rol']
]">


    <form method="POST" action="{{ route('admin.roles.store') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700">Nombre del rol</label>
            <input type="text" name="name" class="w-full border-gray-300 rounded" required>
        </div>

        <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Guardar
        </button>
    </form>

</x-admin-layout>
