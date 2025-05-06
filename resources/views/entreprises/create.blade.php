<x-app-layout>
    <div class="max-w-3xl mx-auto mt-12 px-6">
        {{-- Flèche de retour --}}
        <a href="{{ route('entreprises.index') }}"
           class="inline-flex items-center text-gray-500 hover:text-indigo-600 transition duration-200 mb-6">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            Retour
        </a>

        <form method="POST" action="{{ route('entreprises.store') }}"
              class="bg-white p-10 rounded-2xl shadow-2xl border border-gray-100">
            @csrf

            <h2 class="text-3xl font-bold mb-8 text-gray-800 text-center">Créer une entreprise</h2>

            {{-- Nom de l'entreprise --}}
            <div class="mb-6">
                <label for="nom" class="block text-gray-700 font-semibold mb-2">Nom de l'entreprise</label>
                <input type="text" name="nom" id="nom" placeholder="Nom de l'entreprise"
                       class="w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400 transition"
                       required>
            </div>

            {{-- Nature --}}
            <div class="mb-6">
                <label for="nature" class="block text-gray-700 font-semibold mb-2">Nature de l'entreprise</label>
                <select name="nature" id="nature"
                        class="w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400 transition"
                        required>
                    <option value="">-- Sélectionner la nature --</option>
                    <option value="Informatique">Informatique</option>
                    <option value="BTP">BTP</option>
                    <option value="Commerce">Commerce</option>
                    <option value="Agriculture">Agriculture</option>
                    <option value="Santé">Santé</option>
                </select>
            </div>

            {{-- IFU --}}
            <div class="mb-6">
                <label for="ifu" class="block text-gray-700 font-semibold mb-2">Numéro IFU</label>
                <input type="text" name="ifu" id="ifu" placeholder="Ex: 1234567890123"
                       class="w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400 transition"
                       required pattern="[0-9]{11,13}" title="L'IFU doit comporter entre 11 et 13 chiffres.">
                <p class="text-sm text-gray-500 mt-1">L’IFU doit comporter entre 11 et 13 chiffres (exigence au Bénin).</p>
            </div>

            {{-- Bouton --}}
            <div class="mt-8 text-center">
                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-xl shadow-md transition duration-300 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-indigo-300">
                    Créer l'entreprise
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
