<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElementCommande extends Model
{
    use HasFactory;

    protected $table = 'element_commandes';

    protected $fillable = ['prix', 'quantite', 'produit_id', 'commande_id'];

    protected $casts = [
        'prix' => 'integer',
        'quantite' => 'integer',
        'produit_id' => 'integer',
        'commande_id' => 'integer',
    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class, 'commande_id');
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }
}