<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestion des Projets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">{{ __('Liste des Projets') }}</h3>
                    <a href="{{ route('admin.projets.create') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow-md mb-4">{{ __('Créer un Projet') }}</a>

                    @if (session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded" role="alert">
                            <strong class="font-bold">{{ __('Succès!') }}</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if ($projets->count() > 0)
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Nom') }}</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Entreprise') }}</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Durée') }}</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Budget') }}</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('État') }}</th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">{{ __('Actions') }}</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($projets as $projet)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $projet->nom }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $projet->entreprise->nom }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $projet->duree }} jours</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $projet->budget }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="{{ $projet->is_active ? 'text-green-500' : 'text-red-500' }}">
                                                {{ $projet->is_active ? __('Actif') : __('Inactif') }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('admin.projets.show', $projet->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">{{ __('Voir') }}</a>
                                            <a href="{{ route('admin.projets.edit', $projet->id) }}" class="text-yellow-500 hover:text-yellow-700 mr-2">{{ __('Modifier') }}</a>
                                            @if ($projet->is_active)
                                                <a href="{{ route('admin.projets.deactivate', $projet->id) }}" class="text-red-600 hover:text-red-900 mr-2" onclick="return confirm('{{ __('Êtes-vous sûr de vouloir désactiver ce projet ?') }}')">{{ __('Désactiver') }}</a>
                                            @else
                                                <a href="{{ route('admin.projets.activate', $projet->id) }}" class="text-green-600 hover:text-green-900">{{ __('Activer') }}</a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td class="px-6 py-4 whitespace-nowrap" colspan="5">{{ __('Aucun projet trouvé.') }}</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $projets->links() }}
                        </div>
                    @else
                        <p>{{ __('Aucun projet trouvé.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>