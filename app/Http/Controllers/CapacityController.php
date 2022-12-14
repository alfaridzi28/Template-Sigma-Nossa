<?php

namespace App\Http\Controllers;

use App\Capacity;
use Illuminate\Http\Request;
use yajra\Datatables\DataTables;
use App\Module;

class CapacityController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Capacity::query();

            return DataTables::of($data)
                ->addColumn('aksi', function ($data) {
                    return '<div class="btn-group">
                <a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $data->id . '" class="btn btn-warning btn-sm editCapacity"><i class="dripicons-document-edit"></i></a>
                <a href="' . route('capacity.destroy', $data->id) . '" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#deleteModal"><i class="dripicons-tag-delete"></i></a>
                </div>
                ';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }

        $modules           = Module::with('submodules')->get();

        return view('capacity.index', compact('modules'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'node'      => ['required'],
            'port'      => ['required'],
            'ruas'      => ['required'],
            'nbr'       => ['required'],
            'capacity'  => ['required'],
            'label'     => ['required'],
            'regional'  => ['required'],
            'link'      => ['required'],
        ]);

        $capacity               = new Capacity;
        $capacity->node         = request('node');
        $capacity->port         = request('port');
        $capacity->ruas         = request('ruas');
        $capacity->nbr          = request('nbr');
        $capacity->capacity     = request('capacity');
        $capacity->label        = request('label');
        $capacity->regional     = request('regional');
        $capacity->link         = request('link');
        $capacity->reporting    = true;
        $capacity->stat         = true;

        if ($capacity->save()) {
            return redirect()->back()->with('message', 'Capacity successfully created');
        } else {
            return redirect()->back()->with('error', 'Cannot Capacity user at the moment');
        }
    }

    public function destroy($id)
    {
        $capacity = Capacity::findOrFail($id);

        if ($capacity->delete()) {
            return redirect()->back()->with('message', 'Capacity successfully deleted');
        } else {
            return redirect()->back()->with('error', 'Cannot delete Capacity at the moment');
        }
    }

    public function edit($id)
    {
        $capacity = Capacity::find($id);
        return response()->json($capacity);
    }

    public function update(Request $request)
    {

        $capacity = Capacity::findOrFail($request->id);

        $capacity->node         = request('node');
        $capacity->port         = request('port');
        $capacity->ruas         = request('ruas');
        $capacity->nbr          = request('nbr');
        $capacity->capacity     = request('capacity');
        $capacity->label        = request('label');
        $capacity->regional     = request('regional');
        $capacity->link         = request('link');

        if ($capacity->save()) {
            return redirect()->back()->with('message', 'Capacity successfully updated');
        } else {
            return redirect()->back()->with('error', 'Cannot update capacity at the moment');
        }
    }

    public function report(Request $request)
    {
        $capacity = Capacity::findOrFail($request->id);

        $capacity->reporting    = $request->reporting;
        $capacity->save();
    }

    public function status(Request $request)
    {
        $capacity = Capacity::findOrFail($request->id);

        $capacity->stat    = $request->stat;
        $capacity->save();
    }
}