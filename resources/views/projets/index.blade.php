<x-app-layout>
    <x-slot name="slot">
        <div class="max-w-7xl mx-auto py-10 px-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Liste des projets</h2>

            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto bg-white shadow-md rounded-2xl">
                <table class="min-w-full table-auto border-collapse">
                    <thead class="bg-gray-100 text-gray-700 text-xs uppercase">
                        <tr>
                            <th class="px-4 py-3 text-left">Nom</th>
                            <th class="px-4 py-3 text-left">Durée</th>
                            <th class="px-4 py-3 text-left">Budget</th>
                            <th class="px-4 py-3 text-left">Entreprise</th>
                            <th class="px-4 py-3 text-left">État</th>
                            <th class="px-4 py-3 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-800 text-sm divide-y divide-gray-200">
                        @forelse ($projets as $projet)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $projet->nom }}</td>
                                <td class="px-4 py-3">{{ $projet->duree }} jours</td>
                                <td class="px-4 py-3">{{ $projet->budget }}</td>
                                <td class="px-4 py-3">{{ $projet->entreprise->nom }}</td>
                                <td class="px-4 py-3">
                                    <span class="{{ $projet->is_active ? 'text-green-500' : 'text-red-500' }}">
                                        {{ $projet->is_active ? __('Actif') : __('Inactif') }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 flex space-x-2">
                                    <a href="{{ route('projets.show', $projet->id) }}" class="bg-indigo-600 text-white text-xs font-medium px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                                        Tableau de bord
                                    </a>
                                    <a href="{{ route('projets.edit', $projet->id) }}" class="bg-blue-500 text-white text-xs font-medium px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                                        Modifier
                                    </a>
                                    @if (!$projet->is_active)
                                        <form action="{{ route('projets.activate', $projet->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit" class="bg-green-500 text-white text-xs font-medium px-4 py-2 rounded-lg hover:bg-green-700 transition" onclick="return confirm('Êtes-vous sûr de vouloir activer ce projet ?')">
                                                Activer
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('projets.deactivate', $projet->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit" class="bg-yellow-500 text-white text-xs font-medium px-4 py-2 rounded-lg hover:bg-yellow-700 transition" onclick="return confirm('Êtes-vous sûr de vouloir désactiver ce projet ?')">
                                                Désactiver
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('projets.destroy', $projet->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white text-xs font-medium px-4 py-2 rounded-lg hover:bg-red-700 transition" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce projet ?')">
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-4 text-center text-gray-500">Aucun projet trouvé.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $projets->links('pagination::tailwind') }}
            </div>

            {{-- Bouton joli pour revenir en arrière --}}
            <div class="mt-6 text-center">
                <a href="{{ route('dashboard') }}" class="inline-block bg-indigo-600 text-white text-lg font-semibold px-6 py-3 rounded-lg shadow-lg hover:bg-indigo-700 hover:shadow-xl transition-all duration-300">
                    ← Retour à l'accueil
                </a>
            </div>
        </div>
    </x-slot>
</x-app-layout>
