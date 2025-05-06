<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de Bord Admin') }}
        </h2>
    </x-slot>

```
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                {{ __('Bienvenue dans le panneau d\'administration !') }}
            </div>
        </div>

        
                @csrf
                <x-primary-button type="submit">
                    {{ __('Se déconnecter') }}
                </x-primary-button>
            </form>
        </div>
    </div>
</div>
```

</x-admin-layout>  peux tu m'ajouter l'affichage du total des projets et l'affichage total des entreprises pour l'admin sur cette page ?
