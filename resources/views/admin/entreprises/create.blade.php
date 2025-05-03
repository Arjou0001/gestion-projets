<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ajouter une entreprise
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Affichage des messages de succès ou d'erreur -->
                    @if(session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Formulaire de création d'entreprise -->
                    <form method="POST" action="{{ route('admin.entreprises.store') }}" class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md mt-10">
                        @csrf

                        <!-- Nom de l'entreprise -->
                        <div class="mb-4">
                            <label for="nom" class="block text-gray-700 font-medium mb-2">Nom de l'entreprise</label>
                            <input type="text" name="nom" id="nom" placeholder="Nom de l'entreprise"
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200" required>
                            @error('nom')
                                <div class="text-red-500 text-xs mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nature de l'entreprise -->
                        <div class="mb-4">
                            <label for="nature" class="block text-gray-700 font-medium mb-2">Nature de l'entreprise</label>
                            <select name="nature" id="nature"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200" required>
                                <option value="">-- Sélectionner la nature --</option>
                                <option value="Informatique">Informatique</option>
                                <option value="BTP">BTP</option>
                                <option value="Commerce">Commerce</option>
                                <option value="Agriculture">Agriculture</option>
                                <option value="Santé">Santé</option>
                            </select>
                            @error('nature')
                                <div class="text-red-500 text-xs mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Numéro IFU -->
                        <div class="mb-4">
                            <label for="ifu" class="block text-gray-700 font-medium mb-2">Numéro IFU</label>
                            <input type="text" name="ifu" id="ifu" placeholder="Ex: 1234567890123"
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200"
                                   required pattern="[0-9]{11,13}" title="L'IFU doit comporter entre 11 et 13 chiffres.">
                            <p class="text-sm text-gray-500 mt-1">L’IFU doit comporter entre 11 et 13 chiffres (exigence au Bénin).</p>
                            @error('ifu')
                                <div class="text-red-500 text-xs mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Sélection du Chef d'Entreprise -->
                        <div class="mb-4">
                            <label for="user_id" class="block text-gray-700 font-medium mb-2">Chef d'entreprise</label>
                            <select name="user_id" id="user_id"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200" required>
                                <option value="">-- Sélectionner un chef d'entreprise --</option>
                                @foreach($chefsEntreprise as $chef)
                                    <option value="{{ $chef->id }}" {{ old('user_id') == $chef->id ? 'selected' : '' }}>
                                        {{ $chef->name }} ({{ $chef->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="text-red-500 text-xs mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Bouton de soumission -->
                        <div class="mt-6">
                            <button type="submit"
                                    class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-md transition duration-200">
                                Créer l'entreprise
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
