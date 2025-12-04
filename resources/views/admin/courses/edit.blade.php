<x-admin-layout :breadcrumbs="[
    ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
    ['name' => 'Cursos', 'href' => route('admin.courses.index')],
    ['name' => 'Editar Curso']
]">

    <div class="max-w-3xl mx-auto py-10 sm:px-6 lg:px-8">
        <form action="{{ route('admin.courses.update', $course) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Título --}}
            <div>
                <x-label for="title" value="Título del Curso" />
                <x-input id="title" name="title" type="text" class="mt-1 block w-full" value="{{ old('title', $course->title) }}" required autofocus />
                @error('title') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- precio -->
            <div>
                <x-label for="price" value="Precio del Curso (MXN)" />
                <x-input id="price" name="price" type="number" step="0.01" class="mt-1 block w-full" value="{{ old('price', $course->price) }}" required />
                @error('price') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- duracion en minutos -->
            <div>
                <x-label for="duration_minutes" value="Duración del Curso (minutos)" />
                <x-input id="duration_minutes" name="duration_minutes" type="number" class="mt-1 block w-full" value="{{ old('duration_minutes', $course->duration_minutes) }}" required />
                @error('duration_minutes') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror    
            </div>


            {{-- Descripción --}}   
            <div>
                <x-label for="description" value="Descripción del Curso" />
                <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>{{ old('description', $course->description) }}</textarea>
                @error('description') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            
            <!-- estado con chekbox -->
            <div class="flex items-center">
                <x-checkbox id="is_active" name="is_active" :checked="old('is_active', $course->is_active)" />
                <x-label for="is_active" class="ml-2" value="Curso Activo" />
                @error('is_active') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            {{-- Botón de Guardar --}}
            <div class="flex items-center justify-end">
                <x-button primary type="submit">
                    Guardar Cambios
                </x-button>
            </div>
        </form>
    </div>

</x-admin-layout>