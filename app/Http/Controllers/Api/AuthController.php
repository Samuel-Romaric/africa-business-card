<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * AuthController gère l'authentification des utilisateurs via l'API.
 *
 * Cette classe fournit des méthodes pour authentifier les utilisateurs et gérer les jetons d'accès.
 */
class AuthController extends Controller
{
    /**
     * Authentifie un utilisateur avec les informations fournies.
     *
     * Cette fonction vérifie les identifiants de l'utilisateur (par exemple, email et mot de passe)
     * et retourne un jeton d'accès si l'authentification est réussie.
     *
     * @param \Illuminate\Http\Request $request La requête contenant les informations d'identification de l'utilisateur.
     * @return \Illuminate\Http\JsonResponse La réponse JSON contenant le jeton d'accès ou un message d'erreur.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!auth()->attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Identifiants invalides'], 401);
        }

        $user = auth()->user();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message' => 'Connecté avec succès',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    }

    /**
     * Enregistre un nouvel utilisateur.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'firstname' => $request->firstname,
            'slug' => Str::slug($request->name . ' ' . $request->firstname),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'manager', // Par défaut, le rôle est défini sur 'manager'
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        // Proceder à son inscription ou souscription dans la table 'inscriptions' et paiement

        return response()->json([
            'message' => 'Utilisateur créé avec succès',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ], 201);
    }

    /**
     * Déconnecte l'utilisateur actuel en révoquant son jeton d'accès.
     *
     * @return \Illuminate\Http\JsonResponse La réponse JSON confirmant la déconnexion.
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Déconnecté avec succès'
        ]);
    }

    public function getUser(Request $request)
    {
        return response()->json($request->user());
    }
}
