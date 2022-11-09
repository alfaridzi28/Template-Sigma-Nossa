<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OblController extends Controller
{
    
    public function clearSD(){
        return !\Str::contains(auth()->user()->module, ['all', 'obl']) ? redirect()->back() : view('obl.clear-sd');
    }

    public function updateSD(){
        return !\Str::contains(auth()->user()->module, ['all', 'obl']) ? redirect()->back() : view('obl.update-sd');
    }

}
