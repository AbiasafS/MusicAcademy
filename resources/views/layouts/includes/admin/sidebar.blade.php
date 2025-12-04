@php
$Links = [
    [
        'name' => 'Dashboard',
        'icon' => 'fa-solid fa-gauge',
        'href' => route('admin.dashboard'),
        'active' => request()->routeIs('admin.dashboard'),
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
];
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

                    {{-- Enlace simple --}}
                    @else
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
