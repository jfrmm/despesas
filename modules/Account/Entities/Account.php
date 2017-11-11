<?php

namespace Modules\Account\Entities;

use Illuminate\Database\Eloquent\Model;

use Modules\Account\Entities\Movement;

class Account extends Model
{
    protected $fillable = [
        'name',
        'iban'
    ];

    public function movements() {
        return $this->hasMany(Movement::class);
    }
}
