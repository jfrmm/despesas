<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimento extends Model
{
    protected $fillable = [
        'conta_id',
        'data',
        'valor',
        'descricao',
    ];
}
