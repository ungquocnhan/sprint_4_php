<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Guarantee extends Model
{
    use HasFactory;

    protected $table = 'guarantee';

    public function products(): HasMany {
        return $this->hasMany(Product::class, 'guarantee_id', 'id');
    }

    public function getAll()
    {
        return $this::select()->orderBy('name')->get();
    }
}
