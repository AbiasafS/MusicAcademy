<x-admin-layout title="Editar curso">
    <h2 class="text-xl font-bold mb-4">Editar curso</h2>

    <form action="{{ route('admin.courses.update', $course) }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium">Título</label>
            <input type="text" name="title" value="{{ old('title', $course->title) }}" class="mt-1 block w-full border rounded p-2" required>
            @error('title')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium">Descripción</label>
            <textarea name="description" class="mt-1 block w-full border rounded p-2">{{ old('description', $course->description) }}</textarea>
            @error('description')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block text-sm">Precio</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $course->price) }}" class="mt-1 block w-full border rounded p-2">
            </div>
            <div>
                <label class="block text-sm">Duración (min)</label>
                <input type="number" name="duration_minutes" value="{{ old('duration_minutes', $course->duration_minutes) }}" class="mt-1 block w-full border rounded p-2">
            </div>
            <div class="flex items-center">
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="published" value="1" {{ old('published', $course->published) ? 'checked' : '' }}>
                    <span>Publicado</span>
                </label>
            </div>
        </div>

        <div class="pt-4">
            <button class="px-4 py-2 bg-indigo-600 text-white rounded">Actualizar</button>
            <a href="{{ route('admin.courses.index') }}" class="ml-2 text-gray-600">Cancelar</a>
        </div>
    </form>
</x-admin-layout>
