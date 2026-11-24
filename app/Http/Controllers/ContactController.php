<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * 1. Action Publique : Enregistrer un message depuis la vitrine
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $contact = Contact::create($validated);

        return response()->json([
            'message' => 'Votre message a bien été envoyé et enregistré !',
            'data' => $contact
        ], 210);
    }

    /**
     * 2. Action Admin : Lister tous les messages reçus dans le Dashboard
     */
    public function index(): JsonResponse
    {
        // Récupère les messages du plus récent au plus ancien
        $messages = Contact::orderBy('created_at', 'desc')->get();
        return response()->json($messages, 200);
    }

    /**
     * 3. Action Admin : Supprimer un message
     */
    public function destroy($id): JsonResponse
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return response()->json([
            'message' => 'Le message a été supprimé avec succès.'
        ], 200);
    }
}
