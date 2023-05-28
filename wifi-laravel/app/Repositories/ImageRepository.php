<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ImageRepository.
 *
 * @package namespace App\Repositories;
 */
interface ImageRepository extends RepositoryInterface
{
    public function getImage();

    public function saveImage($image);

    public function getImageByIdProduct(int $id);

    public function updateImage(array $image, mixed $id);
}
