<x-admin-layout title="Cursos">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold">Cursos</h2>
        <a href="{{ route('admin.courses.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded">Nuevo curso</a>
    </div>

    @if(session('success'))
        <div class="p-3 mb-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded">
        <table class="min-w-full">
            <thead>
                <tr class="text-left">
                    <th class="p-3">Título</th>
                    <th class="p-3">Precio</th>
                    <th class="p-3">Publicado</th>
                    <th class="p-3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($courses as $course)
                    <tr class="border-t">
                        <td class="p-3">{{ $course->title }}</td>
                        <td class="p-3">{{ number_format($course->price,2) }}</td>
                        <td class="p-3">{{ $course->published ? 'Sí' : 'No' }}</td>
                        <td class="p-3 space-x-2">
                            <a href="{{ route('admin.courses.edit', $course) }}" class="text-indigo-600">Editar</a>
                            <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Eliminar curso?')" class="text-red-600">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td class="p-3" colspan="4">No hay cursos aún.</td></tr>
                @endforelse
            </tbody>
        </table>

        <div class="p-4">
            {{ $courses->links() }}
        </div>
    </div>
</x-admin-layout>
