<?php

namespace Modules\Account\Entities;

use Illuminate\Database\Eloquent\Model;

use Modules\Account\Entities\WithdrawalType;

class Withdrawal extends Model
{
    public function type()
    {
        return $this->hasOne(WithdrawalType::class);
    }
}
