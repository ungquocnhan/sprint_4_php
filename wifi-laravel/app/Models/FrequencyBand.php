<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FrequencyBand extends Model
{
    use HasFactory;

    protected $table = 'frequency_band';

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'coverage_density_id', 'id');
    }

    public function getAll()
    {
        return $this::select()->orderBy('name')->get();
    }
}
