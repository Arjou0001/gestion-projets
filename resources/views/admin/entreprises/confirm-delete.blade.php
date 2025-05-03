<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Confirmer la suppression de l'Entreprise : {{ $entreprise->nom }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p class="mb-4">
                        Êtes-vous sûr de vouloir supprimer l'entreprise <strong>{{ $entreprise->nom }}</strong> (IFU: {{ $entreprise->ifu }}) ?
                        Cette action est irréversible.
                    </p>

                    <form method="POST" action="{{ route('admin.entreprises.delete', $entreprise->id) }}">
                        @csrf