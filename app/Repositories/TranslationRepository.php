<?php

namespace App\Repositories;

use App\Models\Translation;

class TranslationRepository extends BaseRepository
{
    public function __construct(Translation $model)
    {
        parent::__construct($model);
    }
}