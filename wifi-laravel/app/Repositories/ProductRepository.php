<?php

namespace App\Repositories;

use App\Models\Product;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ProductRepository.
 *
 * @package namespace App\Repositories;
 */
interface ProductRepository extends RepositoryInterface
{
    public function getAllProducts($filters, $keySearch, $perPage);

    public function saveProduct($product);

    public function getById($id);

    public function updateProducts($product, $id);

    public function deleteProduct($id);
}
