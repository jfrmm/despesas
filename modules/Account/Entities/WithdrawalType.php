<?php

namespace Modules\Account\Entities;

use Illuminate\Database\Eloquent\Model;

class WithdrawalType extends Model
{
    protected $fillable = [
        'name',
    ];
}
