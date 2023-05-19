<?php

namespace App\Repositories;

use App\Models\CompanyNew;

class CompanyNewRepository extends BaseRepository
{
    public function __construct(CompanyNew $model)
    {
        parent::__construct($model);
    }
}