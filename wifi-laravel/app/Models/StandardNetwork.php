<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StandardNetwork extends Model
{
    use HasFactory;

    protected $table = 'standard_network';

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'standard_network_id', 'id');
    }

    public function getAll()
    {
        return $this::select()->orderBy('name')->get();
    }
}
