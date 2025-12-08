@props(['title' => 'Panel', 'breadcrumbs' => []])

<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- FontAwesome --}}
    <link 
        rel="stylesheet" 
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" 
        crossorigin="anonymous" 
        referrerpolicy="no-referrer" />
    <!-- sweet alert 2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/96d842fa1c.js" crossorigin="anonymous"></script>
</head>

<body class="bg-gray-100">

    {{-- NAVBAR --}}
    @include('layouts.includes.admin.navigation')

    {{-- SIDEBAR --}}
    @include('layouts.includes.admin.sidebar')

    <div class="p-4 sm:ml-64 mt-16">

        {{-- Breadcrumbs --}}
        <nav class="flex mb-4 text-sm text-gray-600">
            @foreach ($breadcrumbs as $bc)
                @if(isset($bc['href']))
                    <a href="{{ $bc['href'] }}" class="hover:underline">{{ $bc['name'] }}</a>
                    @if(!$loop->last)
                        <span class="mx-2">/</span>
                    @endif
                @else
                    <span>{{ $bc['name'] }}</span>
                @endif
            @endforeach
        </nav>

        {{-- ACCIONES (BOTONES COMO "NUEVO") --}}
        @if (isset($action))
            <div class="mb-4 flex justify-end">
                {{ $action }}
            </div>
        @endif

        {{-- CONTENIDO --}}
        <div class="bg-white shadow rounded p-4">
            {{ $slot }}
        </div>

    </div>

     <!-- mostrar sweetalert -->
        {{-- CÓDIGO CORRECTO --}}
        @if (session('swal'))
        <script>
        Swal.fire({
            title: '{{ session('swal')['title'] }}', // <--- Así accedes al título
            text: '{{ session('swal')['text'] }}',   // <--- Así al texto
            icon: '{{ session('swal')['icon'] }}',   // <--- Y así al ícono
            timer: {{ session('swal')['timer'] ?? 3000 }} // timer es un número, no un string
        });
        </script>
@endif

        <script>
            //buscar todos los elemntos ed una clase espeficica 
            forms = document.querySelectorAll('.delete-form');
            forms.forEach(form => {
                // Agregar un listener para el evento submit
                form.addEventListener('submit', function(event) {
                    event.preventDefault(); // Prevenir el envío inmediato del formulario

                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "¡No podrás revertir esto!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, eliminarlo!',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // Enviar el formulario si el usuario confirma
                        }
                    });
                });
            });
        </script>

</body>
</html>
