<?php

namespace App\Helpers\DedicatedFiltering;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

/**
 * Based on Laracasts Dedicated Query String Filtering
 * @https://github.com/laracasts/Dedicated-Query-String-Filtering
 */
abstract class QuerySort
{
    /**
     * The request object.
     *
     * @var Request
     */
    protected $request;

    /**
     * The builder instance.
     *
     * @var Builder
     */
    protected $builder;

    /**
     * Create a new QuerySorts instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply the sorts to the builder.
     *
     * @param  Builder $builder
     *
     * @return Builder
     */
    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->sorts() as $name => $value) {
            if (!method_exists($this, $name)) {
                continue;
            }

            if (strlen($value)) {
                $this->$name($value);
            } else {
                $this->$name();
            }
        }

        return $this->builder;
    }

    /**
     * Get all request sorts data.
     *
     * @return array
     */
    public function sorts()
    {
        return $this->request->all();
    }

    /**
     * Return the request
     *
     * @return Request
     */
    public function request()
    {
        return $this->request;
    }
}
