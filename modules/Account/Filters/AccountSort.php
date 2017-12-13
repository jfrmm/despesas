<?php
namespace Modules\Account\Filters;

use App\Helpers\DedicatedFiltering\QuerySort;
use Illuminate\Database\Eloquent\Builder;

class AccountSort extends QuerySort
{
    /**
     * Sort by id
     *
     * @param string $order
     *
     * @return Builder
     */
    public function id($order = 'asc')
    {
        return $this->builder->orderBy('id', $order);
    }

    /**
     * Sort by name
     *
     * @param string $order
     *
     * @return Builder
     */
    public function name($order = 'asc')
    {
        return $this->builder->orderBy('name', $order);
    }

    /**
     * Sort by iban
     *
     * @param string $order
     *
     * @return Builder
     */
    public function iban($order = 'asc')
    {
        return $this->builder->orderBy('iban', $order);
    }

    /**
     * Sort by created_at
     *
     * @param string $order
     *
     * @return Builder
     */
    public function created_at($order = 'asc')
    {
        return $this->builder->orderBy('created_at', $order);
    }

    /**
     * Sort by updated_at
     *
     * @param string $order
     *
     * @return Builder
     */
    public function updated_at($order = 'asc')
    {
        return $this->builder->orderBy('updated_at', $order);
    }

    /**
     * Sort by deleted_at
     *
     * @param string $order
     *
     * @return Builder
     */
    public function deleted_at($order = 'asc')
    {
        return $this->builder->orderBy('deleted_at', $order);
    }
}
