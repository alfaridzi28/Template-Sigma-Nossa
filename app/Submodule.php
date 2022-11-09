<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submodule extends Model
{
    protected $fillable = ['subtitle', 'module_id', 'url', 'slug'];

    public function modules()
    {
        return $this->belongsTo(Module::class, 'module_id', 'id');
    }
}
