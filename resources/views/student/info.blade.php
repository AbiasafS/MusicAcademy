<x-admin-layout :breadcrumbs="[['name' => 'información']]">

    <h1 class="text-2xl font-bold mb-4">Mi información</h1>

    <div class="p-4 bg-white rounded-lg shadow">
        <p><strong>Nombre:</strong> {{ Auth::user()->name }}</p>
        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
        <p><strong>Rol:</strong> Student</p>
    </div>
<script src="//unpkg.com/alpinejs" defer></script>
</x-admin-layout>
