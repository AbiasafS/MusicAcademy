<x-admin-layout :breadcrumbs="[
    ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
    ['name' => 'Usuarios', 'href' => route('admin.users.index')],
    ['name' => 'Crear usuario']
]">

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        
        <div class="space-y-3">
            <div>
                <label>Nombre</label>
                <input type="text" name="name" class="form-input w-full" required>
            </div>

            <div>
                <label>Email</label>
                <input type="email" name="email" class="form-input w-full" required>
            </div>

            <div>
                <label>Contraseña</label>
                <input type="password" name="password" class="form-input w-full" required>
            </div>
        </div>

        <button class="mt-4 px-4 py-2 bg-green-600 text-white rounded">
            Guardar
        </button>
    </form>

</x-admin-layout>
