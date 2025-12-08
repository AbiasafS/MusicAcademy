<div class="flex items-center space-x-2">

    {{-- Editar --}}
    <a href="{{ route('admin.roles.edit', $role) }}"
       class="px-2 py-1 bg-blue-600 text-white rounded text-xs hover:bg-blue-700 transition">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>

    {{-- Eliminar --}}
    <form class="delete-form" action="{{ route('admin.roles.destroy', $role) }}" method="POST"
          >
        @csrf
        @method('DELETE')
        <button type="submit"
                class="px-2 py-1 bg-red-600 text-white rounded text-xs hover:bg-red-700 transition">
            <i class="fa-solid fa-trash"></i>
        </button>
    </form>

</div>
