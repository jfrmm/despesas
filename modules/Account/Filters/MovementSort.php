<?php
namespace Modules\Account\Filters;

use App\Helpers\DedicatedFiltering\QuerySort;
use Illuminate\Database\Eloquent\Builder;

class MovementSort extends QuerySort
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
     * Sort by date
     *
     * @param string $order
     *
     * @return Builder
     */
    public function date($order = 'asc')
    {
        return $this->builder->orderBy('date', $order);
    }

    /**
     * Sort by amount
     *
     * @param string $order
     *
     * @return Builder
     */
    public function amount($order = 'asc')
    {
        return $this->builder->orderBy('amount', $order);
    }

    /**
     * Sort by description
     *
     * @param string $order
     *
     * @return Builder
     */
    public function description($order = 'asc')
    {
        return $this->builder->orderBy('description', $order);
    }

    /**
     * Sort by account_id
     *
     * @param string $order
     *
     * @return Builder
     */
    public function account_id($order = 'asc')
    {
        return $this->builder->orderBy('account_id', $order);
    }

    /**
     * Sort by creator_id
     *
     * @param string $order
     *
     * @return Builder
     */
    public function creator_id($order = 'asc')
    {
        return $this->builder->orderBy('creator_id', $order);
    }

    /**
     * Sort by creditor_id
     *
     * @param string $order
     *
     * @return Builder
     */
    public function creditor_id($order = 'asc')
    {
        return $this->builder->orderBy('creditor_id', $order);
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
