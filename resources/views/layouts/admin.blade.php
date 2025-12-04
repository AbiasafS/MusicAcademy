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



    <script src="https://kit.fontawesome.com/96d842fa1c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-TL0J...etc" crossorigin="anonymous" referrerpolicy="no-referrer" />

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

        <!-- dropdown -->
         

        {{-- Contenido --}}
        <div class="bg-white shadow rounded p-4">
            {{ $slot }}
        </div>

    </div>

</body>
</html>
