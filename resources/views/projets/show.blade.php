<x-app-layout>
    <x-slot name="slot">
        <div class="max-w-6xl mx-auto px-6 py-10">
            <h2 class="text-3xl font-extrabold text-gray-800 mb-6">{{ __('Détails du projet : ') }}<span class="text-indigo-600">{{ $projet->nom }}</span></h2>

            @if(session('success'))
                <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 px-6 py-4 rounded-lg shadow-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white p-8 rounded-2xl shadow-xl mb-8">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6">Résumé du projet</h3>
                <ul class="space-y-4 text-gray-700 text-lg">
                    @foreach($dataPourResumes as $key => $value)
                        <li class="flex items-center space-x-2">
                            <span class="font-medium text-gray-600">{{ ucfirst(str_replace('_', ' ', $key)) }} :</span>
                            <span>{{ is_array($value) ? implode(', ', $value) : $value }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- ➡️ Partie pour afficher les tâches du projet (depuis maquette_taches) --}}
            @if (!empty($taches) && is_array($taches))
                <div class="bg-white p-8 rounded-2xl shadow-xl mb-8">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-6">Tâches associées</h3>
                    <ul class="list-disc list-inside space-y-4 text-lg text-gray-700">
                        @foreach ($taches as $tache)
                            <li>{{ $tache }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(!empty($dataPourCharts))
                <div class="bg-white p-8 rounded-2xl shadow-xl mb-8">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-6">Visualisation du projet</h3>
                    <div class="w-full overflow-x-auto">
                        <canvas id="projectChart" class="w-full max-w-4xl mx-auto"></canvas>
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
                                plugins: {
                                    legend: {
                                        position: 'top',
                                        labels: {
                                            color: '#4B5563', // Légende avec une couleur douce
                                            font: {
                                                size: 14
                                            }
                                        }
                                    },
                                    tooltip: {
                                        backgroundColor: 'rgba(0, 0, 0, 0.7)', // Tooltip sombre
                                        titleColor: '#fff',
                                        bodyColor: '#fff',
                                    }
                                }
                            }
                        });
                    </script>
                </div>
            @else
                <p class="text-gray-600 text-lg">Aucune visualisation disponible pour ce type de projet.</p>
            @endif

            <div class="mt-8 text-center">
                <a href="{{ route('projets.index') }}" class="inline-block bg-indigo-600 text-white text-lg font-medium px-6 py-3 rounded-full hover:bg-indigo-700 transition duration-300 ease-in-out">
                    ← Retour à la liste des projets
                </a>
            </div>
        </div>
    </x-slot>
</x-app-layout>
