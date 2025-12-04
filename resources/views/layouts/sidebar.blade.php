<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0"
    aria-label="Sidebar">

    <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
        <ul class="space-y-2 font-medium">

            <li>
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M3 7h18M3 12h18M3 17h18"/>
                    </svg>
                    <span>Dashboard</span>
                </a>
            </li>

            <li>
               <a href="{{ route('admin.courses.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
        <svg class="w-5 h-5 mr-3" ...></svg>
        <span>Cursos</span>
    </a>

        </ul>
    </div>
</aside>
