<?php
declare(strict_types=1);

namespace App\Http\Requests\Commande;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCommandeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('commande');
        return [
            'date' => ['sometimes','date', ],
            'code' => ['sometimes','string','max:255', ],
            'methode_paiement' => ['sometimes','string','max:255', ],
            'statut' => ['sometimes','string','max:255', ],
        ];
    }
}
