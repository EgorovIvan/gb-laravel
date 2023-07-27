<?php

declare(strict_types=1);

namespace App\Queries;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ProfilesQueryBuilder extends QueryBuilder
{
    public function getModel(): Builder
    {
        return User::query();
    }

    public function getAll(): Collection
    {
        return $this->getModel()->get();
    }
}
