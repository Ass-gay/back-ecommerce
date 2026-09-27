<?php
declare(strict_types=1);

namespace App\Http\Requests\Commande;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommandeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
        'date' => 'required|date',
        'code' => 'required|string|max:255',
        'methode_paiement' => 'required|string|max:255',
        'statut' => 'required|string|max:255',
    ];
    }
}
