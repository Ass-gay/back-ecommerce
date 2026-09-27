<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'categories';

    protected $fillable = ['libelle', 'description'];

    protected $casts = [
        'libelle' => 'string',
        'description' => 'string',
    ];

    public function produits() {
        return $this->hasMany(Produit::class,'categorie_id');
    }
}
