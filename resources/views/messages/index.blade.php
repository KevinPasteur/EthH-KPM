<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Page Chat') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                        <p class="font-bold">Succès</p>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif
                <div class="bg-white border-b border-gray-200">
                    @if (Auth::user()->role->name == 'Administrateur' || Auth::user()->role->name == 'Éditeur')
                        <form action="{{ route('messages.store') }}" method="POST"
                            class="p-6 bg-white border-b border-gray-200">
                            @csrf
                            <textarea name="content" class="w-full rounded border-gray-300"></textarea>
                            <button type="submit"
                                class="mt-2 px-4 py-2 bg-blue-500 hover:bg-blue-700 rounded text-white">Envoyer</button>
                        </form>
                    @endif
                    <div id="messagesContainer" class="p-6 bg-white border-gray-200">
                        @foreach ($messages as $message)
                            <div class="mt-4 p-4 bg-gray-100 rounded">
                                <p class="text-sm text-gray-600">{{ $message->created_at->format('d-m-y H:i') }}</p>
                                <strong class="text-lg text-gray-800">{{ $message->user->email }}</strong>
                                <p>{{ $message->content }}</p>
                                @if (Auth::user()->role->name == 'Administrateur')
                                    <form action="{{ route('messages.destroy', $message) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="mt-2 px-4 py-2 bg-red-500 hover:bg-red-700 rounded text-white">Supprimer</button>
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
