<x-admin-layout :breadcrumbs="[
    ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
    ['name' => 'Usuarios', 'href' => route('admin.users.index')],
    ['name' => 'Editar usuario']
]">

    <div class="card bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                {{-- Nombre --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" name="name" value="{{ $user->name }}" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                </div>

                {{-- Sección de Roles --}}
                <div class="pt-4 border-t border-gray-200">
                    <label class="block text-lg font-medium text-gray-700 mb-2">Asignar Roles</label>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach ($roles as $role)
                            <label class="flex items-center space-x-2 p-2 border rounded hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" 
                                       name="roles[]" 
                                       value="{{ $role->id }}" 
                                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                       @checked($user->roles->contains($role->id))>
                                <span class="text-gray-700 capitalize">
                                    {{ $role->name }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Actualizar Usuario
                </button>
            </div>
        </form>
    </div>

</x-admin-layout>