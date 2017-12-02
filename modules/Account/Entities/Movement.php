<?php
namespace Modules\Account\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Modules\Account\Entities\Withdrawal;
use Modules\Account\Entities\Deposit;

class Movement extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'date',
        'amount',
        'description',
        'account_id',
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
    }
}
