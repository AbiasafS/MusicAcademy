<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://kit.fontawesome.com/96d842fa1c.js" crossorigin="anonymous"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <!-- NAVBAR -->
    <nav class="bg-white border-b border-gray-200 px-4 py-3 flex justify-between items-center fixed top-0 left-0 right-0 z-50">
        <div class="flex items-center">
            <!-- Mobile sidebar button -->
            <button data-drawer-target="sidebar" data-drawer-toggle="sidebar"
                    class="p-2 mr-3 text-gray-600 rounded-lg hover:bg-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>

            <span class="text-xl font-bold">MusicAcademy</span>
        </div>

        <!-- USER DROPDOWN (FUNCIONANDO) -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open"
                class="flex items-center text-gray-700 hover:text-gray-900 focus:outline-none">
                <span class="mr-2">{{ Auth::user()->name }}</span>
                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 011.08 1.04l-4.25 4.25a.75.75 0 01-1.08 0L5.23 8.27a.75.75 0 01.02-1.06z"
                        clip-rule="evenodd"/>
                </svg>
            </button>

            <!-- Dropdown -->
            <div x-show="open"
                 @click.away="open = true"
                 class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-md py-2 z-50">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- CONTENT -->
    <main class="p-6 sm:ml-64 mt-20">
        {{ $slot }}
    </main>

    @wireUiScripts
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>

</body>
</html>
