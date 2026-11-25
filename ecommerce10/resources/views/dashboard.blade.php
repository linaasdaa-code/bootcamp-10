<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="text-lg">Halo, <strong>{{ Auth::user()->name }}</strong>! 👋</p>
                    <p class="mt-2 text-gray-600">Selamat datang di dashboard Suvoire.</p>

                    <a href="{{ route('products.index') }}"
                       class="inline-block mt-4 px-4 py-2 bg-gray-800 text-white rounded-md">
                        Lihat Produk
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>