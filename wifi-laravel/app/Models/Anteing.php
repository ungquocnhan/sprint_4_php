<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Anteing extends Model
{
    use HasFactory;

    protected $table = 'anteing';

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'anteing_id', 'id');
    }

    public function getAll()
    {
        return $this::select()->orderBy('quantity')->get();

    }
}
