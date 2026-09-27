<?php
declare(strict_types=1);

namespace App\Http\Requests\ElementCommande;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateElementCommandeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('element_commande');
        return [
            'prix' => ['sometimes','integer', ],
            'quantite' => ['sometimes','integer', ],
            'produit_id' => ['sometimes','integer','exists:produits,id', ],
            'commande_id' => ['sometimes','integer','exists:commandes,id', ],
        ];
    }
}
