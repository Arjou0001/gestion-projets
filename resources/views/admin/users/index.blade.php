<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestion des Chefs d'Entreprise
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- Messages de succès ou d’erreur --}}
                    @if(session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- Bouton d’ajout --}}
                    <div class="mb-6">
                        <a href="{{ route('admin.users.create') }}"
                           class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded shadow">
                            + Ajouter un Chef d'Entreprise
                        </a>
                    </div>

                    {{-- Tableau des chefs d’entreprise --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm text-gray-700">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 text-left font-medium uppercase tracking-wider">Nom</th>
                                    <th class="px-6 py-3 text-left font-medium uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-right font-medium uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($chefsEntreprise as $chef)
                                    <tr>
                                        <td class="px-6 py-4">{{ $chef->name }}</td>
                                        <td class="px-6 py-4">{{ $chef->email }}</td>
                                        <td class="px-6 py-4 text-right space-x-2">
                                            <a href="{{ route('admin.users.edit', $chef->id) }}"
                                               class="text-indigo-600 hover:text-indigo-800 font-medium">
                                                Modifier
                                            </a>
                                            <form action="{{ route('admin.users.delete', $chef->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="text-red-600 hover:text-red-800 font-medium"
                                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                                                    Supprimer
                                                </button>
                                            </form>
                                            <a href="{{ route('admin.entreprises.create', ['chef_id' => $chef->id]) }}"
                                               class="bg-blue-500 hover:bg-blue-700 text-white py-1.5 px-3 rounded font-medium shadow">
                                                + Entreprise
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 text-center text-gray-500">Aucun chef d'entreprise trouvé.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination (facultative) --}}
                    {{-- <div class="mt-6">
                        {{ $chefsEntreprise->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
