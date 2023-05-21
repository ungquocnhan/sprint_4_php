<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeAnteing extends Model
{
    use HasFactory;

    protected $table = 'type_anteing';

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'type_anteing_id', 'id');
    }

    public function getAll()
    {
        return $this::select()->orderBy('name')->get();
    }
}
