<?php

declare(strict_types=1);

namespace App\Queries;

use App\Models\DataSource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class DataSourcesQueryBuilder extends QueryBuilder
{
    public function getModel(): Builder
    {
        return DataSource::query();
    }

    public function getAll(): Collection
    {
        return $this->getModel()->get();
    }
}
