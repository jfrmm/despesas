<?php

namespace App\Helpers\DedicatedFiltering;

use Illuminate\Database\Eloquent\Builder;

trait Sortable
{
    /**
     * Sort a result set.
     *
     * @param  Builder    $query
     * @param  QuerySort  $sort
     *
     * @return Builder
     */
    public function scopeSort($query, QuerySort $sort)
    {
        return $sort->apply($query);
    }
}
