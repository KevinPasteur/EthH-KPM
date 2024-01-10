<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Page Administrateur') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
    @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                        <p class="font-bold">Succès</p>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif
    @if (session('error'))
            <div class="container mx-auto p-4">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            </div>
        @endif
        @foreach ($users as $user)
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col">
                <div class="mb-4">
                    <h3 class="font-bold text-xl mb-2">{{ $user->email }}</h3>
                    <p class="text-gray-700 text-base">Compte créé le: {{ $user->created_at->format('d/m/Y') }}</p>
                    <p class="text-gray-600 text-sm">Rôle actuel: {{ $user->role->name }}</p>
                </div>

                @if ($user->id != auth()->user()->id)
                <form action="{{ route('admin.changeRole', $user) }}" method="POST" class="mt-4">
                    @csrf
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="role_id">
                            Changer le rôle:
                        </label>
                        <select
                            class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            name="role_id" id="role_id">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}"
                                    {{ $user->role->id === $role->id ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Mettre à jour
                    </button>
                    @endif
                </form>
            </div>
        @endforeach
    </div>

</x-app-layout>
