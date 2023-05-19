<?php

namespace App\Services;

use App\Repositories\TranslationRepository;


class TranslationService extends BaseService
{
    public function __construct(TranslationRepository $repository)
    {
        $this->repository = $repository;
    }

}