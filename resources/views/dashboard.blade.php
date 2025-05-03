<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg mt-6">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-4">Actions</h3>

                    <div class="mb-4 flex items-center space-x-4">
                        <a href="{{ route('entreprises.create') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow-md">
                            Ajouter une entreprise
                        </a>
                        <a href="{{ route('projets.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md">
                            Créer un projet
                        </a>
                        <a href="{{ route('projets.index') }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg shadow-md">
                            Voir la liste des projets
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg mt-6">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-4">Liste de vos entreprises</h3>

                    @if(session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded" role="alert">
                            <strong class="font-bold">Succès!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(Auth::user()->entreprises->isEmpty())
                        <p>Aucune entreprise n'est associée à votre compte pour le moment.</p>
                    @else
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nature</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IFU</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">État</th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach(Auth::user()->entreprises()->paginate(10) as $entreprise)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $entreprise->nom }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $entreprise->nature }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $entreprise->ifu }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="{{ $entreprise->is_active ? 'text-green-500' : 'text-red-500' }}">
                                                {{ $entreprise->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('entreprises.edit', $entreprise->id) }}" class="text-yellow-500 hover:text-yellow-700 mr-2">Modifier</a>
                                            @if (!$entreprise->is_active)
                                                <a href="{{ route('entreprises.activate', $entreprise->id) }}" class="text-green-600 hover:text-green-900">Réactiver</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4">
                            {{ Auth::user()->entreprises()->paginate(10)->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>