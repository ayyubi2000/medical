<?php

namespace App\Services;

use App\Repositories\SettingRepository;


class SettingService extends BaseService
{
    public function __construct(SettingRepository $repository)
    {
        $this->repository = $repository;
    }

}