<?php

namespace App\Helpers\DedicatedFiltering;

trait Searchable
{
    /**
     * Get the model searchable fields, these are defined in the model itself,
     * with protected $searchable
     *
     * @return mixed
     */
    public function getSearchable()
    {
        if (!empty($this->searchable) && is_array($this->searchable)) {
            return $this->searchable;
        }
        return false;
    }
}
