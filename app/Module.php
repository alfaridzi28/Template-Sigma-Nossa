<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = ['title'];

    public function submodules()
    {
        return $this->hasMany(Submodule::class, 'module_id');
    }
}
