<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfillingBcp extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'sqminternet_rcalogic.view_sqm_bcp_summary_v3';
    // protected $fillable = ['node', 'port', 'ruas', 'nbr', 'capacity', 'label', 'regional', 'link', 'reporting', 'stat'];
}