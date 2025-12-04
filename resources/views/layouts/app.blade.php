<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://kit.fontawesome.com/96d842fa1c.js" crossorigin="anonymous"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <!-- NAVBAR -->
    <nav class="bg-white border-b border-gray-200 px-4 py-3 flex justify-between items-center">
        <div class="flex items-center">
            <!-- Button mobile sidebar -->
            <button data-drawer-target="sidebar" data-drawer-toggle="sidebar"
                    class="p-2 mr-3 text-gray-600 rounded-lg hover:bg-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>

            <span class="text-xl font-bold">MusicAcademy</span>
        </div>

        <!-- DROPDOWN USER -->
        <div>
            <button id="user-menu-button" data-dropdown-toggle="user-dropdown" class="flex items-center">
                <img class="w-9 h-9 rounded-full" src="https://www.gravatar.com/avatar?d=mp">
            </button>

            <div id="user-dropdown"
                 class="hidden z-10 bg-white rounded-lg shadow w-44">
                <ul class="py-2 text-sm text-gray-700">

                    <li>
                        <a href="{{ route('profile.show') }}"
                           class="block px-4 py-2 hover:bg-gray-100">
                            Perfil
                        </a>
                    </li>

                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="w-full text-left px-4 py-2 hover:bg-gray-100">
                                Salir
                            </button>
                        </form>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <!-- SIDEBAR -->
    <aside id="sidebar"
           class="fixed top-0 left-0 w-64 h-screen pt-16 bg-white border-r border-gray-200 -translate-x-full transition-transform"
           aria-label="Sidebar">

        <div class="h-full px-3 py-5 overflow-y-auto">

            <ul class="space-y-2 font-medium">

                <li>
                    <a href="/dashboard"
                       class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100">
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="/admin"
                       class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100">
                        <span class="ml-3">Admin</span>
                    </a>
                </li>

                <li>
                    <button class="flex items-center p-2 w-full text-gray-900 rounded-lg hover:bg-gray-100"
                            data-collapse-toggle="submenu-cursos">
                        <span class="flex-1 ml-3 text-left">Cursos</span>
                    </button>

                    <ul id="submenu-cursos" class="hidden py-2 space-y-2">
                        <li>
                            <a href="/admin/courses"
                               class="block p-2 pl-8 text-gray-700 hover:bg-gray-200 rounded-lg">
                                Cursos
                            </a>
                        </li>
                        <li>
                            <a href="/admin/roles"
                               class="block p-2 pl-8 text-gray-700 hover:bg-gray-200 rounded-lg">
                                Roles
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </aside>

    <!-- CONTENT -->
    <main class="p-6 sm:ml-64 mt-16">
        {{ $slot }}
    </main>
    @wireUiScripts

</body>
</html>
