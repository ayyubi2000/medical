<?php

namespace App\Services;

use App\Repositories\CarouselRepository;


class CarouselService extends BaseService
{
    public function __construct(CarouselRepository $repository)
    {
        $this->repository = $repository;
    }

}