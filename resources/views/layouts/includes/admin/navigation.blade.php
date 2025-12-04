<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200">
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">

      {{-- LEFT: botón menú + logo --}}
      <div class="flex items-center justify-start">
        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
          aria-controls="logo-sidebar" type="button"
          class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
          <span class="sr-only">Open sidebar</span>
          <svg class="w-6 h-6" aria-hidden="true" fill="currentColor"
            viewBox="0 0 20 20">
            <path fill-rule="evenodd" clip-rule="evenodd"
              d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0
              010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0
              01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0
              01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75
              0 010 1.5H2.75A.75.75 0 012 10z"/>
          </svg>
        </button>

        <a href="{{ route('admin.dashboard') }}" class="flex ml-2 md:mr-24">
          <img src="{{ asset('imagenes/unnamed.jpg') }}" class="h-8 mr-3" alt="MusicAcademy Logo">
          <span class="self-center text-xl font-semibold whitespace-nowrap">MusicAcademy</span>
        </a>
      </div>

       
       


        <div class="ml-3 relative">
    <x-dropdown align="right" width="48">
        <x-slot name="trigger">
            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                    <img class="h-9 w-9 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                </button>
            @else
                <span class="inline-flex rounded-md">
                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                        {{ Auth::user()->name }}
                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                </span>
            @endif
        </x-slot>

        <x-slot name="content">
            <!-- Perfil -->
            <x-dropdown-link href="{{ route('profile.show') }}">
                {{ __('Perfil') }}
            </x-dropdown-link>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link href="{{ route('logout') }}"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Salir') }}
                </x-dropdown-link>
            </form>
        </x-slot>
    </x-dropdown>
</div>


     
    </div>
  </div>
</nav>
