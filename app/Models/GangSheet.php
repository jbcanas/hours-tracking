<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GangSheet extends Model
{
    protected $guarded = [];

    public function employees()
    {
        return $this->hasMany('App\Models\GangSheetEmployee');
    }
}
