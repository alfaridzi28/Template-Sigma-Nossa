<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function create(){
        return !\Str::contains(auth()->user()->module, ['all', 'customer-location']) ? redirect()->back() : view('customer-location.create');
    }
}
