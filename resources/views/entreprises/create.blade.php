<x-app-layout>
 <form method="POST" action="{{ route('entreprises.store') }}" class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md mt-10">
    @csrf

    <h2 class="text-2xl font-bold mb-6 text-gray-800">Créer une entreprise</h2>

    {{-- Nom de l'entreprise --}}
    <div class="mb-4">
        <label for="nom" class="block text-gray-700 font-medium mb-2">Nom de l'entreprise</label>
        <input type="text" name="nom" id="nom" placeholder="Nom de l'entreprise"
            class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200" required>
    </div>

    {{-- Nature de l'entreprise --}}
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
    </div>

    {{-- IFU --}}
    <div class="mb-4">
    <label for="ifu" class="block text-gray-700 font-medium mb-2">Numéro IFU</label>
    <input type="text" name="ifu" id="ifu" placeholder="Ex: 1234567890123"
           class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200"
           required pattern="[0-9]{11,13}" title="L'IFU doit comporter entre 11 et 13 chiffres.">
    <p class="text-sm text-gray-500 mt-1">L’IFU doit comporter entre 11 et 13 chiffres (exigence au Bénin).</p>
</div>

    {{-- Bouton --}}
    <div class="mt-6">
        <button type="submit"
            class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-md transition duration-200">
            Créer l'entreprise
        </button>
    </div>
</form>
</x-app-layout>
