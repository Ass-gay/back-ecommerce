<?php
declare(strict_types=1);

namespace App\Http\Requests\Service;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
        'libelle' => 'required|string|max:90',
        'description' => 'required|string|max:65535',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Accepte les vrais fichiers images
    ];
    }
}
