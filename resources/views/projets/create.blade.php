<x-app-layout>
    <div class="max-w-4xl mx-auto py-12 px-6">
        {{-- Flèche de retour --}}
        <a href="{{ route('entreprises.index') }}"
           class="inline-flex items-center text-gray-500 hover:text-indigo-600 transition duration-200 mb-6">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            Retour
        </a>

        <div class="bg-white shadow-2xl border border-gray-100 rounded-2xl p-10">
            <h2 class="text-3xl font-bold text-gray-800 mb-10 text-center">Créer un nouveau projet</h2>

            <form action="{{ route('projets.store') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Entreprise --}}
                <div>
                    <label for="entreprise_id" class="block font-semibold text-gray-700 mb-2">Entreprise</label>
                    <select name="entreprise_id" id="entreprise_id"
                            class="w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-indigo-300 transition"
                            required>
                        <option value="">Sélectionnez une entreprise</option>
                        @foreach($entreprises as $entreprise)
                            <option value="{{ $entreprise->id }}" data-nature="{{ $entreprise->nature }}">
                                {{ $entreprise->nom }} ({{ $entreprise->nature }})
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Exemple projet --}}
                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Exemple de projet possible</label>
                    <div id="exemples-projets">
                        <select name="exemple_projet_id"
                                class="w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-indigo-300 transition">
                            <option value="">-- Veuillez sélectionner une entreprise --</option>
                        </select>
                    </div>
                </div>

                {{-- Nom du projet --}}
                <div>
                    <label for="nom" class="block font-semibold text-gray-700 mb-2">Nom du projet</label>
                    <input type="text" name="nom"
                           class="w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-indigo-300 transition"
                           required>
                </div>

                {{-- Durée --}}
                <div>
                    <label for="duree" class="block font-semibold text-gray-700 mb-2">Durée (en jours)</label>
                    <input type="number" name="duree" min="1"
                           class="w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-indigo-300 transition"
                           required>
                </div>

                {{-- Budget --}}
                <div>
                    <label for="budget" class="block font-semibold text-gray-700 mb-2">Budget</label>
                    <input type="number" name="budget" step="0.01" min="1"
                           class="w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-indigo-300 transition"
                           required>
                </div>

                {{-- Nombre de personnes --}}
                <div>
                    <label for="nombre_personnes" class="block font-semibold text-gray-700 mb-2">Nombre de personnes</label>
                    <input type="number" name="nombre_personnes" min="1"
                           class="w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-indigo-300 transition"
                           required>
                </div>

                {{-- Bouton --}}
                <div class="pt-6">
                    <button type="submit"
                            class="w-full bg-indigo-600 text-white font-bold py-3 px-8 rounded-xl hover:bg-indigo-700 transition duration-300 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-indigo-300">
                        Créer le projet
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Script dynamique --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const entrepriseSelect = document.getElementById('entreprise_id');
            const exemplesProjetsDiv = document.getElementById('exemples-projets');

            entrepriseSelect.addEventListener('change', function () {
                const selectedOption = this.options[this.selectedIndex];
                const natureEntreprise = selectedOption.getAttribute('data-nature');

                if (natureEntreprise) {
                    fetch(`/projets/exemples/${natureEntreprise}`)
                        .then(response => response.json())
                        .then(data => {
                            const select = document.createElement('select');
                            select.name = 'exemple_projet_id';
                            select.className = 'w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-indigo-300 transition';
                            select.innerHTML = '<option value="">-- Sélectionnez un exemple --</option>';

                            if (data.length > 0) {
                                data.forEach(exemple => {
                                    const option = document.createElement('option');
                                    option.value = exemple.id;
                                    option.textContent = exemple.intitule;
                                    select.appendChild(option);
                                });
                            } else {
                                const option = document.createElement('option');
                                option.value = '';
                                option.textContent = 'Aucun exemple trouvé';
                                select.appendChild(option);
                            }

                            exemplesProjetsDiv.innerHTML = '';
                            exemplesProjetsDiv.appendChild(select);
                        })
                        .catch(() => {
                            exemplesProjetsDiv.innerHTML = '<p class="text-red-600 text-sm mt-2">Erreur lors du chargement.</p>';
                        });
                } else {
                    exemplesProjetsDiv.innerHTML = `
                        <select name="exemple_projet_id" class="w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-indigo-300 transition">
                            <option value="">-- Veuillez sélectionner une entreprise --</option>
                        </select>`;
                }
            });
        });
    </script>
</x-app-layout>
