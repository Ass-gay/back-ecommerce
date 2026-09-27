<?php
declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommandeResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'date' => $this->date,
            'code' => $this->code,
            'methode_paiement' => $this->methode_paiement,
            'statut' => $this->statut,
        ];
    }
}
