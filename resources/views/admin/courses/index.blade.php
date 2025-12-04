<x-admin-layout :breadcrumbs="[
    ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
    ['name' => 'Cursos', 'href' => route('admin.courses.index')],
]">

    <x-slot name="action">
        <x-wire-button blue href="{{ route('admin.courses.create') }}">
            <i class="fa-solid fa-plus"></i>
            Nuevo
        </x-wire-button>
    </x-slot>

    @livewire('admin.datatables.courses-table')
    <br>

    <!-- boton para asignar alumnos a las clases
        <div class="mt-6">
            <x-wire-button blue href="{{ route('admin.courses.assign-users') }}">
                <i class="fa-solid fa-plus"></i>
                Asignar 
            </x-wire-button>
        </div>
    
    <!- tabla de relacion entre cursos y estudiantes -->
    <!-- @livewire('admin.datatables.course-user-table') --> 
     
</x-admin-layout>
