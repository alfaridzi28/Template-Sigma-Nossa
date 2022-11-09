<?php

namespace App\Http\Controllers;

use App\Module;
use App\Submodule;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index() {
         $modules   = Module::with('submodules')->get();

        return view('module.index', compact('modules'));
    }

    public function store(Request $request) {

        request()->validate([
            'title'  => ['unique:modules,title'],
        ]);

        $module                = new Module;
        $module->title         = request('title');

        if($module->save()){
            return redirect()->back()->with('message', 'Module successfully created');
        } else {
            return redirect()->back()->with('error', 'Cannot Module user at the moment');
        }
    }

    public function show(Module $module)
    {
        $title = "Detail Module";
        $modules   = Module::with('submodules')->get();

        return view('module.show', compact('title', 'module', 'modules'));
    }

    public function destroy($id)
    {
        $module = Module::findOrFail($id);

        if($module->delete()){
            return redirect()->back()->with('message', 'Module successfully deleted');
        } else {
            return redirect()->back()->with('error', 'Cannot delete module at the moment');
        }
    }

    public function update(Request $request) {

        $module = Module::findOrFail($request->id);

        $module->title      = request('title');

        if($module->save()){
            return redirect()->back()->with('message', 'Module successfully updated');
        } else {
            return redirect()->back()->with('error', 'Cannot update module at the moment');
        }
    }
}
