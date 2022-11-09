<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchItemController extends Controller
{
    public function byAssetNumber(){
        return view('search-item.by-asset-number');
    }

    public function byServiceID(){
        return view('search-item.by-service-id');
    }

    public function byWildcard(){
        return view('search-item.by-wildcard');
    }
}
