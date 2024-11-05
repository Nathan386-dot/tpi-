<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'current_password' => 'required|string|current_password',
            'password' => 'nullable|string|min:8|confirmed', // Assurez-vous d'utiliser 'confirmed'
        ];
    }

    // Ajoutez un message personnalisé si la confirmation échoue
    public function messages()
    {
        return [
            'password.confirmed' => 'Veuillez vérifier de nouveau votre mot de passe.',
        ];
    }
}