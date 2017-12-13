<?php
namespace Modules\Account\Repositories;

use App\Helpers\BaseRepository\Eloquent\BaseRepository;
use Illuminate\Http\Request;
use Modules\Account\Entities\Creditor;
use Modules\Account\Filters\MovementSort;

class CreditorMovementRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return Creditor::class;
    }

    /**
     * Get a creditor with a relationship
     *
     * @param MovementSort $sort
     * @param int $id
     * @param array $relationship
     */
    public function getAllRelated(MovementSort $sort, $id, $relationship)
    {
        return $this->allRelated($sort, $id, ['*'], $relationship);
    }

    /**
     * Get a creditor
     *
     * @param Request $request
     * @param int $id
     *
     * @return Creditor
     */
    public function getOne(Request $request, $id)
    {
        return $this->find($request, $id);
    }

    /**
     * Assign multiple movements to the creditor
     *
     * @param Request $request
     * @param int $id
     *
     * @return void
     */
    public function attachMultiple(Request $request, $id)
    {
        return $this->attach($request, $id);
    }

    /**
     * Dissociate multiple movements from the creditor
     *
     * @param Request $request
     * @param int $id
     *
     * @return void
     */
    public function detachMultiple(Request $request, $id)
    {
        return $this->detach($request, $id);
    }
}
