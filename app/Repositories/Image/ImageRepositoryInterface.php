<?php

namespace App\Repositories\Image;

use App\Repositories\RepositoryInterface;

interface ImageRepositoryInterface extends RepositoryInterface
{
    public function upload($form_data, $roomId);
    public function deleteById($imageId);
    public function createUniqueFilename($filename, $path);
    public function original($photo, $filename, $path);
    public function sanitize($string, $force_lowercase = true, $anal = false);
    public function getListImagesByRoom($roomId);
}