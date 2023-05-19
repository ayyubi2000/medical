<?php

namespace App\Services;

use App\Repositories\CompanyNewRepository;


class CompanyNewService extends BaseService
{
    public function __construct(CompanyNewRepository $repository)
    {
        $this->repository = $repository;
    }

}