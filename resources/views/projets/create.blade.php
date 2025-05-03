<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-6">
        <div class="bg-white shadow-md rounded-2xl p-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Créer un nouveau projet</h2>

            <form action="{{ route('projets.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="entreprise_id" class="block font-medium text-gray-700 mb-1">Entreprise</label>
                    <select name="entreprise_id" id="entreprise_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200" required>
                        <option value="">Sélectionnez une entreprise</option>
                        @foreach($entreprises as $entreprise)
                            <option value="{{ $entreprise->id }}" data-nature="{{ $entreprise->nature }}">
                                {{ $entreprise->nom }} ({{ $entreprise->nature }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-medium text-gray-700 mb-1">Exemple de projet possible</label>
                    <div id="exemples-projets">
                        <select name="exemple_projet_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200">
                            <option value="">-- Veuillez sélectionner une entreprise --</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="nom" class="block font-medium text-gray-700 mb-1">Nom du projet</label>
                    <input type="text" name="nom" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200" required>
                </div>

                <div>
                    <label for="duree" class="block font-medium text-gray-700 mb-1">Durée (en jours)</label>
                    <input type="number" name="duree" min="1" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200" required>
                </div>

                <div>
                    <label for="budget" class="block font-medium text-gray-700 mb-1">Budget</label>
                    <input type="number" name="budget" step="0.01" min="1" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200" required>
                </div>

                <div>
                    <label for="nombre_personnes" class="block font-medium text-gray-700 mb-1">Nombre de personnes</label>
                    <input type="number" name="nombre_personnes" min="1" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200" required>
                </div>

                <div>
                    <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 transition duration-200">
                        Créer le projet
                    </button>
                </div>
            </form>
        </div>
    </div>

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
                            exemplesProjetsDiv.innerHTML = '';
                            const select = document.createElement('select');
                            select.name = 'exemple_projet_id';
                            select.className = 'w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200';
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

                            exemplesProjetsDiv.appendChild(select);
                        })
                        .catch(error => {
                            console.error('Erreur lors de la récupération des exemples :', error);
                            exemplesProjetsDiv.innerHTML = '<p class="text-red-600 text-sm mt-1">Erreur lors du chargement.</p>';
                        });
                } else {
                    exemplesProjetsDiv.innerHTML = `
                        <select name="exemple_projet_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200">
                            <option value="">-- Veuillez sélectionner une entreprise --</option>
                        </select>
                    `;
                }
            });
        });
    </script>
</x-app-layout>
