<?php
namespace Modules\Account\Repositories;

use Illuminate\Http\Request;
use App\Helpers\BaseRepository\Eloquent\BaseRepository;

use Modules\Account\Entities\Account;

class AccountRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return Account::class;
    }

    /**
     * Get all the items
     *
     * @param Request $request
     *
     * @return Account
     */
    public function getAll(Request $request)
    {
        return $this->all($request);
    }

    /**
     * Create or update an item
     *
     * @param Request $request
     * @param Account $account
     *
     * @return Account
     */
    public function createOrUpdate(Request $request, Account $account = null)
    {
        if (is_null($account)) {
            /**
             * Let's try and create
             */

            $account = $this->create($request);
        } else {
            /**
             * Let's try and update
             */

            $account = $this->update($request, $account->id);
        }

        return $account;
    }

    /**
     * Get an item
     *
     * @param Request $request
     * @param uuid $id
     *
     * @return Account
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
     * @return Account
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