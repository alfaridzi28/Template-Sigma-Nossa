<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use yajra\Datatables\DataTables;
use App\Module;
use App\ProfillingBcp;
use Illuminate\Database\Eloquent\Model;

class ProfillingBcpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            if (!empty($request->filter_regional)) {
                $data = ProfillingBcp::groupBy('regional', 'witel', 'rating')
                    ->selectRaw('count(*) as count, regional, witel, rating')
                    ->where('regional', $request->filter_regional)
                    ->where('witel', $request->filter_witel)
                    ->get();
            } else {
                $data = ProfillingBcp::groupBy('regional', 'witel', 'rating')
                    ->selectRaw('count(*) as count, regional, witel, rating')
                    ->get();
            }

            return DataTables::of($data)
                ->addColumn('witel', function ($query) {
                    $witel = $query->witel;
                    return '<a href=' . url("/profillingbcp-sto?witel=$witel") . ' id="sto_witel">' . $witel . '</a>';
                })
                ->rawColumns(['witel'])
                ->make(true);
        }

        $regional = ProfillingBcp::select('regional')->groupBy('regional')->orderBy('regional', 'asc')->get();

        $witel = ProfillingBcp::select('witel')->groupBy('witel')->orderBy('witel', 'asc')->get();

        $modules = Module::with('submodules')->get();

        return view('profillingbcp.index', compact('modules', 'regional', 'witel'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showsto(Request $request)
    {
        $witel = $request->get('witel');

        if ($request->ajax()) {

            if ($request->witel) {

                $data = ProfillingBcp::groupBy('sto', 'rating')
                    ->selectRaw('count(*) as count, sto, rating')
                    ->where('witel', $request->witel)
                    ->get();
            }

            return DataTables::of($data)
                ->addColumn('sto', function ($query) {
                    $sto = $query->sto;
                    return '<a href=' . url("profillingbcp-gpon?sto=$sto") . '>' . $sto . '</a>';
                })
                ->rawColumns(['sto'])
                ->make(true);
        }

        $modules = Module::with('submodules')->get();

        return view('profillingbcp.sto', compact('modules', 'witel'));
    }

    public function showgpon(Request $request)
    {
        $sto = $request->get('sto');

        if ($request->ajax()) {

            if ($request->sto) {

                $data = ProfillingBcp::groupBy('clid', 'rating')
                    ->selectRaw('count(*) as count, clid, rating')
                    ->where('sto', $request->sto)
                    ->get();
            }

            return DataTables::of($data)
                ->addColumn('clid', function ($query) {
                    $clid = $query->clid;
                    return '<a href=' . url("profillingbcp-all?clid=$clid") . '>' . $clid . '</a>';
                })
                ->rawColumns(['clid'])
                ->make(true);
        }

        $modules = Module::with('submodules')->get();

        return view('profillingbcp.gpon', compact('modules', 'sto'));
    }

    public function showall(Request $request)
    {
        $clid = $request->get('clid');

        if ($request->ajax()) {

            if ($request->clid) {

                $data = ProfillingBcp::where('clid', '=', $request->clid)->get();
            }

            return DataTables::of($data)->make(true);
        }

        $modules = Module::with('submodules')->get();

        return view('profillingbcp.all', compact('modules', 'clid'));
    }
}