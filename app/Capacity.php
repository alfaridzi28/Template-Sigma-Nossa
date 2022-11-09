<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Capacity extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'ai_traffic.capacity';
    protected $fillable = ['node', 'port', 'ruas', 'nbr', 'capacity', 'label', 'regional', 'link', 'reporting', 'stat'];
}
