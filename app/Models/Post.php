<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = ['libelle', 'description', 'image'];

    protected $casts = [
        'libelle' => 'string',
        'description' => 'string',
        'image' => 'string',
    ];
}