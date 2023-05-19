<?php

namespace App\Services;

use App\Repositories\PartnerRepository;


class PartnerService extends BaseService
{
    public function __construct(PartnerRepository $repository)
    {
        $this->repository = $repository;
    }

}