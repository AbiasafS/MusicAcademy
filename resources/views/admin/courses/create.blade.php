<x-admin-layout :breadcrumbs="[
    ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
    ['name' => 'Cursos', 'href' => route('admin.courses.index')],
    ['name' => 'Nuevo Curso']
]">

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4">Crear Nuevo Curso</h2>

        <form action="{{ route('admin.courses.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Título --}}
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Título del Curso</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Precio --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Precio ($)</label>
                    <input type="number" step="0.01" name="price" value="{{ old('price', 0) }}" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                </div>

                {{-- Duración --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Duración (minutos)</label>
                    <input type="number" name="duration_minutes" value="{{ old('duration_minutes') }}" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>

                {{-- Descripción --}}
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Descripción</label>
                    <textarea name="description" rows="4" class="form-textarea mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('description') }}</textarea>
                </div>

                {{-- Publicado --}}
                <div class="col-span-2">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="published" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" {{ old('published') ? 'checked' : '' }}>
                        <span class="ml-2 text-gray-700">Publicar este curso inmediatamente</span>
                    </label>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <a href="{{ route('admin.courses.index') }}" class="mr-3 px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">Cancelar</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Guardar Curso</button>
            </div>
        </form>
    </div>

</x-admin-layout>