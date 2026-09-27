<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';

    protected $fillable = ['libelle', 'description', 'image'];

    protected $casts = [
        'libelle' => 'string',
        'description' => 'string',
        'image' => 'string',
    ];
}