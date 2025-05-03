<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier l\'entreprise') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('entreprises.update', $entreprise->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nom" class="block text-gray-700 font-medium mb-2">Nom</label>
                            <input type="text" name="nom" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200" value="{{ old('nom', $entreprise->nom) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="nature" class="form-label">Nature</label>
                            <input type="text" name="nature" class="form-control" value="{{ $entreprise->nature }}" readonly>
                        </div>


                        <div class="mb-3">
                            <label for="ifu" class="block text-gray-700 font-medium mb-2">IFU</label>
                            <input type="text" name="ifu" id="ifu" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 bg-gray-100 cursor-not-allowed" value="{{ old('ifu', $entreprise->ifu) }}"
                                readonly pattern="[0-9]{11,13}" title="L'IFU doit comporter entre 11 et 13 chiffres. Ce champ n'est pas modifiable.">
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('entreprises.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Annuler
                            </a>

                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150 ml-4">
                                Mettre à jour
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>