<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produit extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'produits';

    protected $fillable = ['libelle', 'description', 'image', 'prix', 'categorie_id'];

    protected $casts = [
        'libelle' => 'string',
        'description' => 'string',
        'image' => 'string',
        'prix' => 'integer',
        'categorie_id' => 'integer',
    ];

    public function categorie()
    {
        return $this->belongsTo(\App\Models\Category::class, 'categorie_id');
    }
}
