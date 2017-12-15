<?php
namespace Modules\Account\Entities;

use App\Helpers\DedicatedFiltering\Searchable;
use App\Helpers\DedicatedFiltering\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Account\Entities\Movement;
use Modules\User\Entities\User;

class Account extends Model
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
        'name',
        'iban',
        'owner_id',
    ];

    /**
     * The attributes that should be used in search
     *
     * @var array
     */
    protected $searchable = [
        'name',
        'iban',
    ];

    /**
     * An account has an owner
     */
    public function owner()
    {
        return $this->hasOne(User::class, 'owner_id');
    }

    /**
     * An account belongs to many users
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * An account has many movements
     */
    public function movements()
    {
        return $this->hasMany(Movement::class);
    }
}
