<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use SoftDeletes;
    use HasFactory;
    public function categorias()
    {
        return $this->belongsToMany(Categoria::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('cantidad');
    }
}
