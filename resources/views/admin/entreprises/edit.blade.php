<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier l'Entreprise : {{ $entreprise->nom }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
            <form method="POST" action="{{ route('admin.entreprises.update', $entreprise->id) }}">
                @csrf
                @method('PUT')

                <h2 class="text-2xl font-bold mb-6 text-gray-800">Modifier l'entreprise</h2>

                {{-- Nom de l'entreprise --}}
                <div class="mb-4">
                    <label for="nom" class="block text-gray-700 font-medium mb-2">Nom de l'entreprise</label>
                    <input type="text" name="nom" id="nom" value="{{ $entreprise->nom }}"
                           class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200" required>
                    @error('nom')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Nature de l'entreprise --}}
                <div class="mb-4">
                    <label for="nature" class="block text-gray-700 font-medium mb-2">Nature de l'entreprise</label>
                    <select name="nature" id="nature"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200" required>
                        <option value="">-- Sélectionner la nature --</option>
                        <option value="Informatique" {{ $entreprise->nature === 'Informatique' ? 'selected' : '' }}>Informatique</option>
                        <option value="BTP" {{ $entreprise->nature === 'BTP' ? 'selected' : '' }}>BTP</option>
                        <option value="Commerce" {{ $entreprise->nature === 'Commerce' ? 'selected' : '' }}>Commerce</option>
                        <option value="Agriculture" {{ $entreprise->nature === 'Agriculture' ? 'selected' : '' }}>Agriculture</option>
                        <option value="Santé" {{ $entreprise->nature === 'Santé' ? 'selected' : '' }}>Santé</option>
                        {{-- Ajoutez d'autres natures si nécessaire --}}
                    </select>
                    @error('nature')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                {{-- IFU --}}
                <div class="mb-4">
                    <label for="ifu" class="block text-gray-700 font-medium mb-2">Numéro IFU</label>
                    <input type="text" name="ifu" id="ifu" value="{{ $entreprise->ifu }}"
                           class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200"
                           required pattern="[0-9]{11,13}" title="L'IFU doit comporter entre 11 et 13 chiffres.">
                    <p class="text-sm text-gray-500 mt-1">L’IFU doit comporter entre 11 et 13 chiffres (exigence au Bénin).</p>
                    @error('ifu')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Bouton --}}
                <div class="mt-6">
                    <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md transition duration-200">
                        Mettre à jour l'entreprise
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>