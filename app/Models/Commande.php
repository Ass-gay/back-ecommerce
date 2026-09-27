<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $table = 'commandes';

    protected $fillable = ['date', 'code', 'methode_paiement', 'statut'];

    protected $casts = [
        'date' => 'date',
        'code' => 'string',
        'methode_paiement' => 'string',
        'statut' => 'string',
    ];

    public function element_commandes()
    {
        return $this->hasMany(ElementCommande::class);
    }
}