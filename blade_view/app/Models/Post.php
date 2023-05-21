<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    //Neu dat ten table ko dung qui dinh thi khai bao
    protected $table = 'post';

    public $timestamps = true;

    protected $fillable = ['title', 'content', 'status'];
//    protected $fillable = ['options->enabled'];
//protected $guarded = [];
    use SoftDeletes;

    use Prunable;

    /**
     * Get the prunable model query.
     */
    public function prunable(): Builder
    {
        return static::where('created_at', '<=', now()->subMonth());
    }
}
