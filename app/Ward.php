<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';

    public function addresses()
    {
        return $this->hasMany(Ward::class, 'id', 'ward_id');
    }
}
