<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier l\'entreprise') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-2xl p-8">
                <form action="{{ route('entreprises.update', $entreprise->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                            <input type="text" name="nom" id="nom" value="{{ old('nom', $entreprise->nom) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200" required>
                            @error('nom') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="nature" class="block text-sm font-medium text-gray-700">Nature</label>
                            <input type="text" name="nature" id="nature" value="{{ $entreprise->nature }}"
                                readonly class="mt-1 block w-full bg-gray-100 rounded-md border-gray-300 shadow-sm cursor-not-allowed text-gray-600">
                        </div>

                        <div>
                            <label for="ifu" class="block text-sm font-medium text-gray-700">IFU</label>
                            <input type="text" name="ifu" id="ifu" value="{{ old('ifu', $entreprise->ifu) }}"
                                readonly pattern="[0-9]{11,13}"
                                title="L'IFU doit comporter entre 11 et 13 chiffres. Ce champ n'est pas modifiable."
                                class="mt-1 block w-full bg-gray-100 rounded-md border-gray-300 shadow-sm cursor-not-allowed text-gray-600">
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-8 space-x-4">
                        <a href="{{ route('entreprises.index') }}"
                            class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-md">
                            Annuler
                        </a>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md">
                            Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
