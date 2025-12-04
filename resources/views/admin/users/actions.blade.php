<div class="flex items-center space-x-2">

    {{-- Editar --}}
    <a href="{{ route('admin.users.edit', $user) }}"
       class="px-2 py-1 bg-blue-600 text-white rounded text-xs hover:bg-blue-700 transition">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>

    {{-- Eliminar --}}
    <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
          onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?');">
        @csrf
        @method('DELETE')
        <button type="submit"
                class="px-2 py-1 bg-red-600 text-white rounded text-xs hover:bg-red-700 transition">
            <i class="fa-solid fa-trash"></i>
        </button>
    </form>

</div>
