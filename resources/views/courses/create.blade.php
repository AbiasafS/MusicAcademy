<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrar Nuevo Curso') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                
                <form action="{{ route('courses.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Nombre del Curso</label>
                            <input type="text" name="name" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full mt-1" required placeholder="Ej: Piano Intermedio">
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Instrumento</label>
                            <input type="text" name="instrument" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full mt-1" required placeholder="Ej: Piano">
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Profesor Encargado</label>
                            <select name="teacher_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full mt-1">
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Horario</label>
                            <input type="text" name="schedule" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full mt-1" required placeholder="Ej: Martes 16:00">
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Precio Mensual</label>
                            <input type="number" step="0.01" name="price" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full mt-1" required>
                        </div>

                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('courses.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Cancelar</a>
                        <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Guardar Curso
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>