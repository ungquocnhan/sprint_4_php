<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserConnect extends Model
{
    use HasFactory;

    protected $table = 'user_connect';

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'user_connect_id', 'id');
    }

    public function getAll()
    {
        return $this::select()->orderBy('name')->get();
    }
}
