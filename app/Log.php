<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'Log';

    public function user()
    {
        return $this->belongsTo(User::class, 'telegram_id');
    }
}
