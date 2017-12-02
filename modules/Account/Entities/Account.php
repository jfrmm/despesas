<?php
namespace Modules\Account\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Modules\Account\Entities\Movement;

class Account extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'iban'
    ];

    public function movements()
    {
        return $this->hasMany(Movement::class);
    }
}
