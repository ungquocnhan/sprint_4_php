<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $table = 'promotion';

    public function products() {
        return $this->hasMany(Product::class, 'promotion_id', 'id');
    }

    public function getAll()
    {
        return $this::select()->orderBy('percent_promotion')->get();
    }
}
