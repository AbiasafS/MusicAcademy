<!-- //acciones para los cursos en el panel de administración -->
<div class="flex items-center space-x-2">
    {{-- Editar --}}
    <a href="{{ route('admin.courses.edit', $course) }}"
       class="px-2 py-1 bg-blue-600 text-white rounded text-xs hover:bg-blue-700 transition">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>

    {{-- Eliminar --}}
    <form action="{{ route('admin.courses.destroy', $course) }}" method="POST"
         class="delete-form">
        @csrf
        @method('DELETE')
        <button type="submit"
                class="px-2 py-1 bg-red-600 text-white rounded text-xs hover:bg-red-700 transition">
            <i class="fa-solid fa-trash"></i>
        </button>
    </form>
</div>