<?php
namespace Modules\Account\Entities;

use Modules\Account\Entities\Movement;
use Modules\User\Entities\User;

class Creditor extends User
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The movements owed to the creditor
     */
    public function movements()
    {
        return $this->hasMany(Movement::class, 'creditor_id');
    }
}
