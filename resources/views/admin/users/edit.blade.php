<x-admin-layout :breadcrumbs="[
    ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
    ['name' => 'Usuarios', 'href' => route('admin.users.index')],
    ['name' => 'Editar usuario']
]">

    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="space-y-3">
            <div>
                <label>Nombre</label>
                <input type="text" name="name" value="{{ $user->name }}" class="form-input w-full" required>
            </div>

            <div>
                <label>Email</label>
                <input type="email" name="email" value="{{ $user->email }}" class="form-input w-full" required>
            </div>
        </div>

        <button class="mt-4 px-4 py-2 bg-green-600 text-white rounded">
            Actualizar
        </button>
    </form>

</x-admin-layout>
