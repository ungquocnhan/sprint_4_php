<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ProductRepository;
use App\Entities\Product;
use App\Validators\ProductValidator;

/**
 * Class ProductRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ProductRepositoryEloquent extends BaseRepository implements ProductRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Product::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getAllProducts($filters = [], $keySearch = null, $perPage = 0)
    {
        $products = DB::table('products AS pr')
            ->join('promotion AS pt', 'pr.promotion_id', '=', 'pt.id')
            ->join('frequency_band AS fb', 'pr.frequency_band_id', '=', 'fb.id')
            ->join('speed_wifi AS sw', 'pr.speed_wifi_id', '=', 'sw.id')
            ->join('user_connect AS uc', 'pr.user_connect_id', '=', 'uc.id')
            ->join('coverage_density AS cd', 'pr.coverage_density_id', '=', 'cd.id')
            ->join('manufacture AS ma', 'pr.manufacture_id', '=', 'ma.id')
            ->join('images AS im', 'im.product_id', '=', 'pr.id')
            ->select('pr.id',
                'pr.name',
                'pr.price',
                'pt.percent_promotion AS percentPromotion',
                'fb.name AS nameFrequencyBand',
                'sw.name AS nameSpeedWifi',
                'uc.name AS nameUserConnect',
                'cd.name AS nameCoverageDensity',
                'ma.name AS nameManufacture',
                'im.url AS imageUrl')
            ->whereNull('pr.deleted_at')
            ->groupBy('im.product_id')
            ->orderBy('im.product_id');

        if (!empty($filters)) {
            $products = $products->where($filters);
        }
        if (!empty($keySearch)) {
            $products = $products->where(function ($query) use ($keySearch) {
                $query->orWhere('pr.name', 'like', '%' . $keySearch . '%');
                $query->orWhere('pr.price', 'like', '%' . $keySearch . '%');
            });
        }

        if (!empty($perPage)) {
            $products = $products->paginate($perPage)->withQueryString();
        }else {
            $products = $products->get();
        }

        return $products;
    }

    public function saveProduct($product)
    {
        return DB::table('products')->insert($product);
    }

    public function getById($id)
    {
        // TODO: Implement getById() method.
    }

    public function updateProducts($product, $id)
    {
        return DB::table('products')
            ->where('id', $id)
            ->update($product);
    }

    public function deleteProduct($id)
    {
        return DB::table('products')
            ->where('id', $id)
            ->delete();
    }
}
