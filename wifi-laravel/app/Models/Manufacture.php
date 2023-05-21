<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Manufacture extends Model
{
    use HasFactory;

    protected $table = 'manufacture';

    public function products() {
        return $this->hasMany(Product::class, 'manufacture_id', 'id');
    }

    public function getAll()
    {
        return $this::select()->orderBy('name')->get();
    }
}
