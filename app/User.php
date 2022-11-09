<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $guarded = ['id'];

    public function getAuthPassword() {
        return \Hash::make($this->password);
    }

    public function logs()
    {
        return $this->hasMany(Log::class, 'telegram_id');
    }
}
