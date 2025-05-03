<x-app-layout>
    <x-slot name="slot">
        <div class="max-w-6xl mx-auto px-6 py-10">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Détails du projet : {{ $projet->nom }}</h2>

            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white p-6 rounded-xl shadow-md mb-8">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Résumé du projet</h3>
                <ul class="space-y-2 text-gray-700">
                    @foreach($dataPourResumes as $key => $value)
                        <li>
                            <span class="font-medium">{{ ucfirst(str_replace('_', ' ', $key)) }} :</span>
                            {{ is_array($value) ? implode(', ', $value) : $value }}
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- ➡️ Partie pour afficher les tâches du projet (depuis maquette_taches) --}}
            @if (!empty($taches) && is_array($taches))
                <div class="bg-white p-6 rounded-xl shadow-md mb-8">
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Tâches associées</h3>
                    <ul class="list-disc list-inside space-y-2 text-gray-700">
                        @foreach ($taches as $tache)
                            <li>{{ $tache }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(!empty($dataPourCharts))
                <div class="bg-white p-6 rounded-xl shadow-md mb-8">
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Visualisation du projet</h3>
                    <div class="w-full overflow-x-auto">
                        <canvas id="projectChart" class="w-full max-w-3xl mx-auto"></canvas>
                    </div>
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script>
                        const ctx = document.getElementById('projectChart').getContext('2d');
                        const projectChart = new Chart(ctx, {
                            type: '{{ $dataPourCharts['type'] }}',
                            data: {
                                labels: @json($dataPourCharts['labels'] ?? []),
                                datasets: @json($dataPourCharts['datasets'] ?? []),
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                            }
                        });
                    </script>
                </div>
            @else
                <p class="text-gray-600">Aucune visualisation disponible pour ce type de projet.</p>
            @endif

            <div class="mt-6">
                <a href="{{ route('projets.index') }}"
                   class="inline-block bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                    ← Retour à la liste des projets
                </a>
            </div>
        </div>
    </x-slot>
</x-app-layout>