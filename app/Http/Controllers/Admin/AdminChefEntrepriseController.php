<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;


class AdminChefEntrepriseController extends Controller
{
    public function index()
{
    $chefsEntreprise = User::where('role', 'entreprise')->get(); // ou selon ta logique
    return view('admin.users.index', compact('chefsEntreprise'));
}

    public function confirmDelete(User $user)
    {
        return view('admin.users.confirm-delete', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Le chef d\'entreprise a été supprimé avec succès.');
    }

    public function create()
    {
        // Votre logique pour afficher le formulaire de création d'un chef d'entreprise ira ici
        return view('admin.users.create'); // Exemple : afficher un formulaire de création
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'in:admin,entreprise'], // Ensure the role is valid
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.users.create')
                ->withErrors($validator)
                ->withInput();
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Le chef d\'entreprise a été ajouté avec succès.');
    }

    public function edit(User $user)
    {
        // Votre logique pour afficher le formulaire d'édition du chef d'entreprise
        return view('admin.users.edit', compact('user')); // Exemple : afficher un formulaire avec les données de l'utilisateur
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id], // Ignorer l'email actuel de l'utilisateur
            'password' => ['nullable', 'string', 'min:8', 'confirmed'], // Le mot de passe est facultatif
            'role' => ['required', 'string', 'in:admin,entreprise'], // Assurez-vous que le rôle est valide
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.users.edit', $user->id)
                ->withErrors($validator)
                ->withInput();
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Le chef d\'entreprise a été mis à jour avec succès.');
    }


}