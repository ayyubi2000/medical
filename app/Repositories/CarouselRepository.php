<?php

namespace App\Repositories;

use App\Models\Carousel;

class CarouselRepository extends BaseRepository
{
    public function __construct(Carousel $model)
    {
        parent::__construct($model);
    }
}