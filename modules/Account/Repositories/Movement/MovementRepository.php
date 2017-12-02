<?php
namespace Modules\Account\Repositories\Movement;

use Illuminate\Http\Request;
use App\Helpers\BaseRepository\Eloquent\BaseRepository;

use Modules\Account\Entities\Movement;

class MovementRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return Movement::class;
    }

    /**
     * Get all the items
     *
     * @param Request $request
     *
     * @return Movement
     */
    public function getAll(Request $request)
    {
        return $this->all($request);
    }

    /**
     * Create or update an item
     *
     * @param Request $request
     * @param Movement $movement
     *
     * @return Movement
     */
    public function createOrUpdate(Request $request, Movement $movement = null)
    {
        if (is_null($movement)) {
            /**
             * Let's try and create
             */

            $movement = $this->create($request);
        } else {
            /**
             * Let's try and update
             */

            $movement = $this->update($request, $movement->id);
        }

        return $movement;
    }

    /**
     * Get an item
     *
     * @param Request $request
     * @param uuid $id
     *
     * @return Movement
     */
    public function getOne(Request $request, $id)
    {
        return $this->find($request, $id);
    }

    /**
     * Get an item, trashed included
     *
     * @param Request $request
     * @param uuid $id
     *
     * @return Movement
     */
    public function getOneWithTrashed(Request $request, $id)
    {
        return $this->find($request, $id, ['*'], [], true);
    }

    /**
     * Delete an item
     *
     * @param Request $request
     * @param uuid $id
     *
     * @return bool
     */
    public function deleteOne(Request $request, $id)
    {
        $this->delete($request, $id);
    }
}