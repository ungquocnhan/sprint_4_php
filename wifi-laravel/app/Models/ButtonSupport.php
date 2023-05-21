<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ButtonSupport extends Model
{
    use HasFactory;
    protected $table = 'button_support';
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'button_support_id', 'id');
    }

    public function getAll()
    {
        return $this::select()->orderBy('name')->get();
    }
}
