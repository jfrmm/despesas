<?php
namespace Modules\User\Repositories;

use Illuminate\Http\Request;
use App\Helpers\BaseRepository\Eloquent\BaseRepository;

use Modules\User\Entities\User;

class UserRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Get all the items
     *
     * @param Request $request
     *
     * @return User
     */
    public function getAll(Request $request)
    {
        return $this->all($request);
    }

    /**
     * Create or update an item
     *
     * @param Request $request
     * @param User $user
     *
     * @return User
     */
    public function createOrUpdate(Request $request, User $user = null)
    {
        if ($request->has('password')) {
            $request->merge(['password' => bcrypt($request->input('password'))]);
        }

        if (is_null($user)) {
            /**
             * Let's try and create
             */

            $user = $this->create($request);
        } else {
            /**
             * Let's try and update
             */

            $user = $this->update($request, $user->id);
        }

        return $user;
    }

    /**
     * Get an item
     *
     * @param Request $request
     * @param uuid $id
     *
     * @return User
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
     * @return User
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