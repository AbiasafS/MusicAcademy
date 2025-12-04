@php
$Links = [];

if (auth()->user()->hasRole('Admin')) {
    $Links = [
        
        [
            'name' => 'Dashboard',
            'icon' => 'fa-solid fa-gauge',
            'href' => route('dashboard'),
            'active' => request()->routeIs('dashboard'),
        ],
        [
            'header' => 'Gestión',
        ],
        [
            'name' => 'Roles y permisos',
            'icon' => 'fa-solid fa-shield-halved',
            'href' => route('admin.roles.index'),
            'active' => request()->routeIs('admin.roles.*'),
        ],
        [
            'name' => 'Usuarios',
            'icon' => 'fa-solid fa-users',
            'href' => route('admin.users.index'),
            'active' => request()->routeIs('admin.users.*'),
        ],
        [
            'name' => 'Cursos',
            'icon' => 'fa-solid fa-book',
            'href' => route('admin.courses.index'),
            'active' => request()->routeIs('admin.courses.*'),
        ],
        [
            'name' => 'Asignar usuarios a cursos',
            'icon' => 'fa-solid fa-user-plus',
            'href' => route('admin.courses.assign-users'),
            'active' => request()->routeIs('admin.courses.assign-users'),
        ],
    ];
} elseif (auth()->user()->hasRole('Instructor')) {
    $Links = [
        [
            'name' => 'Dashboard',
            'icon' => 'fa-solid fa-gauge',
            'href' => route('dashboard'),
            'active' => request()->routeIs('dashboard'),
        ],
        [
            'header' => 'Gestión',
        ],
        [
            'name' => 'Cursos',
            'icon' => 'fa-solid fa-book',
            'href' => route('instructor.courses.index'),
            'active' => request()->routeIs('instructor.courses.*'),
        ],
    ];
} elseif (auth()->user()->hasRole('Student')) {
    $Links = [
        [
            'name' => 'Dashboard',
            'icon' => 'fa-solid fa-gauge',
            'href' => route('dashboard'),
            'active' => request()->routeIs('dashboard'),
        ],
        [
            'header' => 'Mi Panel',
        ],
        [
            'name' => 'Mi información',
            'icon' => 'fa-solid fa-user',
            'href' => route('student.info'),
            'active' => request()->routeIs('student.info'),
        ],
    ];
}
@endphp

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 bg-white border-r border-gray-200 sm:translate-x-0"
    aria-label="Sidebar">

    <div class="h-full px-3 pb-4 overflow-y-auto bg-white">

        <ul class="space-y-2 font-medium">

            @foreach ($Links as $link)
                <li>
                    {{-- Encabezado --}}
                    @isset($link['header'])
                        <div class="px-3 mt-4 mb-2 text-xs font-semibold text-gray-500 uppercase">
                            {{ $link['header'] }}
                        </div>
                    @else
                        {{-- Enlace simple --}}
                        <a href="{{ $link['href'] }}"
                            class="flex items-center p-2 rounded-lg hover:bg-gray-100
                                {{ $link['active'] ? 'bg-gray-100' : '' }}">
                            <i class="{{ $link['icon'] }} w-5"></i>
                            <span class="ms-3">{{ $link['name'] }}</span>
                        </a>
                    @endisset
                </li>
            @endforeach

        </ul>

    </div>
</aside>