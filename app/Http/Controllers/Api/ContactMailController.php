<?php

namespace App\Http\Controllers\Api;

use App\Models\ContactMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail as SendMail;
use Illuminate\Support\Facades\Validator;

class ContactMailController extends Controller
{
    public function store(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'services' => 'required|array', // Champs "services" doit être un tableau
            'services.*' => 'string', // Tous les éléments du tableau "services" doivent être des chaînes de caractères
            'budget' => 'required|array|size:2', // Champs "budget" doit être un tableau de taille 2
            'budget.*' => 'integer', // Tous les éléments du tableau "budget" doivent être des entiers
            'company' => 'required|string',
            'email' => 'required|email',
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'message' => 'required|string',
            'phoneNumber' => 'nullable|string',
            'website' => 'nullable|string',
        ]);

        // Création d'un nouveau contact de messagerie
        $contactMail = ContactMail::create([
            'services' => json_encode($validatedData['services']), // Convertir le tableau en JSON
            'budget' => json_encode($validatedData['budget']), // Convertir le tableau en JSON
            'company' => $validatedData['company'],
            'email' => $validatedData['email'],
            'firstName' => $validatedData['firstName'],
            'lastName' => $validatedData['lastName'],
            'message' => $validatedData['message'],
            'phoneNumber' => $validatedData['phoneNumber'],
            'website' => $validatedData['website'],
        ]);

        // Envoi de l'e-mail
        Mail::to(['d.brault@madin-ia.com','Jh.Joseph@madin-ia.com', 's.jacques@madin-ia.com ', 'a.loza@madin-ia.com'])->send(new SendMail($contactMail));

        // Retourne les informations du nouveau contact de messagerie au format JSON
        return response()->json($contactMail, 201);
    }
}
