<?php
declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'libelle' => $this->libelle,
            'description' => $this->description,
            'image' => $this->image,
        ];
    }
}
