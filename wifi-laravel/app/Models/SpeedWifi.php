<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SpeedWifi extends Model
{
    use HasFactory;

    protected $table = 'speed_wifi';

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'speed_wifi_id', 'id');
    }

    public function getAll()
    {
        return $this::select()->orderBy('name')->get();
    }
}
