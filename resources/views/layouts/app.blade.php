<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="https://kit.fontawesome.com/96d842fa1c.js" crossorigin="anonymous"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @livewireStyles
</head>

<body class="bg-gray-100">

    {{-- NAVBAR --}}
    {{-- ... tu navbar igual ... --}}

    <main class="p-6 sm:ml-64 mt-20">
        {{ $slot }}
    </main>

    {{-- SOLO WireUI (igual que Back) --}}
    @wireUiScripts
    <wireui:scripts />

    {{-- Flowbite --}}
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>

    {{-- MOSTRAR SWEETALERT SI HAY Swal --}}
    <x-notifications />
    
</body>
</html>
