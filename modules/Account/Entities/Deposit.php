<?php

namespace Modules\Account\Entities;

use Illuminate\Database\Eloquent\Model;

use Modules\Account\Entities\DepositType;

class Deposit extends Model
{
    public function type()
    {
        return $this->hasOne(DepositType::class);
    }
}
