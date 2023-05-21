<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MadeIn extends Model
{
    use HasFactory;

    protected $table = 'made_in';

    public function products() {
        return $this->hasMany(Product::class, 'made_in_id', 'id');
    }

    public function getAll()
    {
        return $this::select()->orderBy('name')->get();
    }
}
