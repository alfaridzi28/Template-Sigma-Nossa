<?php

namespace App\Http\Controllers;

use App\Submodule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubmoduleController extends Controller
{

    public function store(Request $request) {

        request()->validate([
            'subtitle'  => ['unique:submodules,subtitle'],
        ]);

        $submodule                = new Submodule();
        $submodule->subtitle      = request('subtitle');
        $slug                     = request('subtitle');
        $submodule->slug          = Str::slug($slug);
        $submodule->module_id     = request('module_id');
        $submodule->url           = request('url');

        if($submodule->save()){
            return redirect()->back()->with('message', 'Submodule successfully created');
        } else {
            return redirect()->back()->with('error', 'Cannot Submodule user at the moment');
        }
    }

    public function destroy($id)
    {
        $submodule = Submodule::findOrFail($id);

        if($submodule->delete()){
            return redirect()->back()->with('message', 'Submodule successfully deleted');
        } else {
            return redirect()->back()->with('error', 'Cannot delete Submodule at the moment');
        }
    }

    public function update(Request $request) {

        $submodule = Submodule::findOrFail($request->id);

        $submodule->subtitle      = request('subtitle');
        $slug                     = request('subtitle');
        $submodule->slug          = Str::slug($slug);
        $submodule->url           = request('url');

        if($submodule->save()){
            return redirect()->back()->with('message', 'Submodule successfully updated');
        } else {
            return redirect()->back()->with('error', 'Cannot update submodule at the moment');
        }
    }
}
