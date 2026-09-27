<?php
declare(strict_types=1);

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('post');
        return [
            'libelle' => ['sometimes','string','max:90', ],
            'description' => ['sometimes','string','max:65535', ],
            'image' => ['sometimes','string','max:255', ],
        ];
    }
}
