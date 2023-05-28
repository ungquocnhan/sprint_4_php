<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ImageRepository;
use App\Entities\Image;
use App\Validators\ImageValidator;

/**
 * Class ImageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ImageRepositoryEloquent extends BaseRepository implements ImageRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Image::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getImage()
    {
        return DB::table('images')->groupBy('product_id')->orderBy('product_id')->get();
    }

    public function saveImage($image)
    {
        return DB::table('images')->insert($image);
    }

    public function getImageByIdProduct(int $id)
    {
        return DB::table('images')
            ->where('product_id', $id)
            ->get();
    }

    public function updateImage(array $image, $id)
    {
        return DB::table('images')
            ->where('id', $id)
            ->update($image);
    }
}
