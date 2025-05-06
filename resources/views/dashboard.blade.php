<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white shadow-md sm:rounded-lg p-6">
                <p class="text-gray-800 text-lg">
                    {{ __("Bienvenue, vous êtes connecté en tant que ") }} 
                    <span class="font-semibold text-indigo-600">{{ ucfirst(Auth::user()->role) }}</span>
                </p>
            </div>

            {{-- ADMIN SECTION --}}
            @if(Auth::user()->role === 'admin')
                <div class="bg-white shadow-md sm:rounded-lg p-6">
                    <h3 class="text-xl font-bold mb-4 text-red-600">Espace Administrateur</h3>
                    <div class="flex flex-wrap gap-4">
                        <x-dashboard-button route="admin.users.index" color="red">Gérer les utilisateurs</x-dashboard-button>
                        <x-dashboard-button route="admin.entreprises.index" color="yellow">Gérer les entreprises</x-dashboard-button>
                        <x-dashboard-button route="admin.projets.index" color="purple">Gérer les projets</x-dashboard-button>
                    </div>
                </div>

            {{-- CHEF D'ENTREPRISE SECTION --}}
            @else
                <div class="bg-white shadow-md sm:rounded-lg p-6">
                    <h3 class="text-xl font-bold mb-4 text-green-600">Espace Chef d'entreprise</h3>
                    <div class="flex flex-wrap gap-4">
                        <x-dashboard-button route="entreprises.create" color="green">Ajouter une entreprise</x-dashboard-button>
                        <x-dashboard-button route="projets.create" color="blue">Créer un projet</x-dashboard-button>
                        <x-dashboard-button route="projets.index" color="indigo">Voir les projets</x-dashboard-button>
                    </div>
                </div>

                <div class="bg-white shadow-md sm:rounded-lg p-6">
                    <h3 class="text-xl font-bold mb-4 text-gray-700">Vos entreprises</h3>

                    @if(session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                            <strong class="font-bold">Succès !</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(Auth::user()->entreprises->isEmpty())
                        <p class="text-gray-600">Aucune entreprise associée pour l’instant.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white divide-y divide-gray-200">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nature</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IFU</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">État</th>
                                        <th class="px-6 py-3"></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach(Auth::user()->entreprises()->paginate(10) as $entreprise)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $entreprise->nom }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $entreprise->nature }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $entreprise->ifu }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full {{ $entreprise->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                                    {{ $entreprise->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right space-x-2 flex justify-end">
                                                <a href="{{ route('entreprises.edit', $entreprise->id) }}" class="text-yellow-500 hover:text-yellow-700">Modifier</a>
                                                @if (!$entreprise->is_active)
                                                    <a href="{{ route('entreprises.activate', $entreprise->id) }}" class="text-green-600 hover:text-green-800">Réactiver</a>
                                                @endif
                                                <form action="{{ route('entreprises.destroy', $entreprise->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette entreprise ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800">Supprimer</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6">
                            {{ Auth::user()->entreprises()->paginate(10)->links() }}
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
