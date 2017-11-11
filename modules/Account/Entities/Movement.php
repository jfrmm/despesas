<?php

namespace Modules\Account\Entities;

use Illuminate\Database\Eloquent\Model;

use Modules\Account\Entities\Withdrawal;
use Modules\Account\Entities\Deposit;

class Movement extends Model
{
    protected $fillable = [
        'date',
        'amount',
        'description',
    ];

    public static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            // create a withdrawal or deposit, depending on the movement
            if ($model->amount < 0) {
                Withdrawal::create(['movement_id' => $model->id]);
            } else {
                Deposit::create(['movement_id' => $model->id]);
            }
        });

        static::deleting(function ($model) {
            // delete associated withdrawal or deposit
            if ($model->amount < 0) {
                Withdrawal::destroy($model->id);
            } else {
                Deposit::destroy($model->id);
            }
        });
    }
}
