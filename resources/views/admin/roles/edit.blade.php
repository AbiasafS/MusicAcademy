<x-admin-layout :breadcrumbs="[
    ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
    ['name' => 'Roles', 'href' => route('admin.roles.index')],
    ['name' => 'Editar rol']
]">

    <form method="POST" action="{{ route('admin.roles.update', $role) }}" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700">Nombre del rol</label>
            <input type="text" name="name" value="{{ $role->name }}" class="w-full border-gray-300 rounded" required>
        </div>

        <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Actualizar
        </button>
    </form>

</x-admin-layout>
