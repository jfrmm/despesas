<?php
namespace Modules\Account\Entities;

use App\Helpers\DedicatedFiltering\Searchable;
use App\Helpers\DedicatedFiltering\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Account\Entities\Movement;

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
    ];

    /**
     * The attributes that should be used in search
     *
     * @var array
     */
    protected $searchable = [
        'name',
    ];

    public function movements()
    {
        return $this->hasMany(Movement::class);
    }
}
