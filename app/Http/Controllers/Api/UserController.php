<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Récupérer tous les utilisateurs
        $users = User::all();

        // Retourner les informations des utilisateurs en JSON
        return response()->json($users);
    }

    public function store(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);

        // Création d'un nouvel utilisateur
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password'])
        ]);

        // Retourner les informations du nouvel utilisateur en JSON
        return response()->json($user, 201);
    }

    public function show(User $user)
    {
        // Retourner les informations de l'utilisateur en JSON
        return response()->json($user);
    }

    public function update(Request $request, User $user)
    {
        // Validation des données
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email',
            'password' => 'sometimes|min:8' // Le mot de passe est optionnel pour la mise à jour
        ]);

        // Mise à jour des informations de l'utilisateur
        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => isset($validatedData['password']) ? bcrypt($validatedData['password']) : $user->password
        ]);

        // Retourner une réponse JSON indiquant la mise à jour
        return response()->json($user);
    }

    public function destroy(User $user)
    {
        // Suppression de l'utilisateur
        $user->delete();

        // Retourner une réponse JSON indiquant la suppression
        return response()->json(['message' => 'User deleted successfully'], 204);
    }
}
