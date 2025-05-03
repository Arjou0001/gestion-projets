<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Liste des Entreprises
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded" role="alert">
                            <strong class="font-bold">Succès!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded" role="alert">
                            <strong class="font-bold">Erreur!</strong>
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    @if ($entreprises->count() > 0)
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nature</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IFU</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Chef d'Entreprise</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">État</th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($entreprises as $entreprise)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $entreprise->nom }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $entreprise->nature }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $entreprise->ifu }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $entreprise->user ? $entreprise->user->name : 'Non attribué' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="{{ $entreprise->is_active ? 'text-green-500' : 'text-red-500' }}">
                                                {{ $entreprise->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('admin.entreprises.edit', $entreprise->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Modifier</a>
                                            @if ($entreprise->is_active)
                                                <a href="{{ route('admin.entreprises.deactivate', $entreprise->id) }}" class="text-red-600 hover:text-red-900 mr-2" onclick="return confirm('Êtes-vous sûr de vouloir désactiver cette entreprise ?')">Désactiver</a>
                                            @else
                                                <a href="{{ route('admin.entreprises.activate', $entreprise->id) }}" class="text-green-600 hover:text-green-900 mr-2">Activer</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $entreprises->links() }}
                        </div>
                    @else
                        <p>Aucune entreprise enregistrée.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>