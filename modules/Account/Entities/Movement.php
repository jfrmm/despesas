<?php
namespace Modules\Account\Entities;

use App\Helpers\DedicatedFiltering\Searchable;
use App\Helpers\DedicatedFiltering\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Account\Entities\Deposit;
use Modules\Account\Entities\Withdrawal;
use Modules\User\Entities\User;

class Movement extends Model
{
    use SoftDeletes;
    use Sortable;
    use Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date',
        'amount',
        'description',
        'account_id',
        'creator_id',
        'creditor_id',
    ];

    /**
     * The attributes that should be used in search
     *
     * @var array
     */
    protected $searchable = [
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
    }

    /**
     * A movement belongs to one account
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * The movement's creator
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    /**
     * The movement's creditor
     */
    public function creditor()
    {
        return $this->belongsTo(User::class, 'creditor_id');
    }
}
