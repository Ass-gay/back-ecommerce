<?php
declare(strict_types=1);

namespace App\Http\Requests\Service;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('service');
        return [
            'libelle' => ['sometimes','string','max:90', ],
            'description' => ['sometimes','string','max:65535', ],
            'image' => ['sometimes','string','max:255', ],
        ];
    }
}
