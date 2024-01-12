<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Page Administrateur - confirmé le mot de passe') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <form action="{{ route('admin.changeRole', $user) }}" method="POST">
                @csrf
                <input type="hidden" name="role_id" value="{{ $role_id }}">

                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Votre mot de passe
                        :</label>
                    <input type="password" name="password" id="password"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Confirmer
                    le changement</button>
            </form>
        </div>
    </div>
</x-app-layout>
