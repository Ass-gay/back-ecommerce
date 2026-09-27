<?php
declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ElementCommandeResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'prix' => $this->prix,
            'quantite' => $this->quantite,
            'produit_id' => $this->produit_id,
            'commande_id' => $this->commande_id,
        ];
    }
}
