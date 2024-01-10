<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Erreur') }}
        </h2>
    </x-slot>
    <div class="alert alert-danger">
        @if (session('error'))
            <div class="container mx-auto p-4">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            </div>
        @endif
    </div>

</x-app-layout>
