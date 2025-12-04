<x-admin-layout :breadcrumbs="[['name' => 'Dashboard']]">

    <h1 class="text-2xl font-bold mb-4">Bienvenido, {{ Auth::user()->name }}</h1>

    {{-- ADMIN --}}
    @role('admin')
        <div class="p-4 bg-gray-100 rounded-md mb-4">
            <h2 class="text-xl font-semibold">Panel de Administración</h2>
            <ul class="list-disc list-inside">
                <li><a href="{{ route('admin.users.index') }}">Usuarios</a></li>
                <li><a href="{{ route('admin.roles.index') }}">Roles y permisos</a></li>
                <li><a href="{{ route('admin.courses.index') }}">Cursos</a></li>
            </ul>
        </div>
    @endrole

    {{-- INSTRUCTOR --}}
    @role('instructor')
        <div class="p-4 bg-gray-100 rounded-md mb-4">
            <h2 class="text-xl font-semibold">Panel de Instructor</h2>
            <ul class="list-disc list-inside">
                <li><a href="{{ route('admin.courses.index') }}">Cursos</a></li>
            </ul>
        </div>
    @endrole

    {{-- STUDENT --}}
    @role('student')
        <div class="p-4 bg-gray-100 rounded-md mb-4">
            <h2 class="text-xl font-semibold">Panel de Estudiante</h2>
            <p>Solo puedes ver tu información personal y los cursos asignados.</p>
        </div>
    @endrole
    <script src="//unpkg.com/alpinejs" defer></script>

</x-admin-layout>