<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Créer un Projet</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">
                <form action="{{ route('admin.projets.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="entreprise_id" class="block font-medium">Entreprise</label>
                        <select name="entreprise_id" id="entreprise_id" class="w-full border p-2">
                            <option value="">-- Sélectionner une entreprise --</option>
                            @foreach ($entreprises as $entreprise)
                                <option value="{{ $entreprise->id }}">{{ $entreprise->nom }} ({{ $entreprise->nature }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="projet_possible_id" class="block font-medium">Modèle de Projet</label>
                        <select name="projet_possible_id" id="projet_possible_id" class="w-full border p-2">
                            <option value="">-- Sélectionner un modèle --</option>
                            {{-- Dynamique via JS --}}
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="nom" class="block font-medium">Nom du projet</label>
                        <input type="text" name="nom" id="nom" class="w-full border p-2" required>
                    </div>

                    <div class="mb-4">
                        <label for="duree" class="block font-medium">Durée (jours)</label>
                        <input type="number" name="duree" id="duree" class="w-full border p-2" min="1" required>
                    </div>

                    <div class="mb-4">
                        <label for="budget" class="block font-medium">Budget</label>
                        <input type="number" name="budget" id="budget" class="w-full border p-2" min="1" required>
                    </div>

                    <div class="mb-4">
                        <label for="nombre_personnes" class="block font-medium">Nombre de personnes</label>
                        <input type="number" name="nombre_personnes" id="nombre_personnes" class="w-full border p-2" min="1" required>
                    </div>

                    <div class="mb-4 flex items-center">
                        <input type="checkbox" name="is_active" id="is_active" class="mr-2">
                        <label for="is_active">Activer le projet</label>
                    </div>

                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        Créer
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('entreprise_id').addEventListener('change', function () {
            let entrepriseId = this.value;
            let selectProjet = document.getElementById('projet_possible_id');
            selectProjet.innerHTML = '<option value="">Chargement...</option>';

            if (entrepriseId) {
                fetch(`/admin/projets-possibles/${entrepriseId}`)
                    .then(res => res.json())
                    .then(data => {
                        selectProjet.innerHTML = '<option value="">-- Sélectionner un modèle --</option>';
                        data.forEach(projet => {
                            let option = document.createElement('option');
                            option.value = projet.id;
                            option.text = `${projet.nature} - ${projet.intitule}`;
                            selectProjet.appendChild(option);
                        });
                    });
            } else {
                selectProjet.innerHTML = '<option value="">-- Sélectionner un modèle --</option>';
            }
        });
    </script>
</x-admin-layout>
