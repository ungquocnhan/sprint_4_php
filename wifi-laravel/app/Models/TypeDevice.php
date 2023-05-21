<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeDevice extends Model
{
    use HasFactory;

    protected $table = 'type_device';

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'type_device_id', 'id');
    }

    public function getAll()
    {
        return $this::select()->orderBy('name')->get();
    }
}
