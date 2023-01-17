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
    public function index(Request $request)
    {
        if ($request->ajax()) {


            $data = ProfillingBcp::groupBy('regional', 'witel', 'rating')
                ->selectRaw('count(*) as count, regional, witel, rating')
                ->get();

            if ($request->input('regionall') != null) {
                $data = ProfillingBcp::groupBy('regional', 'witel', 'rating')
                    ->selectRaw('count(*) as count, regional, witel, rating')
                    ->where('regional', $request->regionall)
                    ->get();
            }
            if ($request->input('witell') != null) {
                $data = ProfillingBcp::groupBy('regional', 'witel', 'rating')
                    ->selectRaw('count(*) as count, regional, witel, rating')
                    ->where('witel', $request->witell)
                    ->get();
            }
            if ($request->input('rating') != '') {
                $data = ProfillingBcp::groupBy('regional', 'witel', 'rating')
                    ->selectRaw('count(*) as count, regional, witel, rating')
                    ->where('rating', $request->rating)
                    ->get();
            }

            return DataTables::of($data)
                ->addColumn('witel', function ($query) {
                    $witel = $query->witel;
                    return
                        '<a href="' . route('profillingbcp.witel', $witel) . '" id="sto_witel">' . $witel . '</a>';
                })
                ->rawColumns(['witel'])
                ->make(true);
        }

        $regional = ProfillingBcp::select('regional')->groupBy('regional')->orderBy('regional', 'asc')->get();

        $witel = ProfillingBcp::select('witel')->groupBy('witel')->orderBy('witel', 'asc')->get();

        return view('profillingbcp.index', compact('regional', 'witel'));
    }

    public function findwitel(Request $request)
    {
        $data['regional'] = ProfillingBcp::where("regional", $request->regional)->groupBy('witel')
            ->get(["witel"]);

        return response()->json($data);
    }

    public function showwitel(Request $request, $witel)
    {

        if ($request->ajax()) {

            $data = ProfillingBcp::groupBy('sto', 'rating')
                ->selectRaw('count(*) as count, sto, rating')
                ->where('witel', $witel)
                ->get();

            if ($request->input('sto') != null) {
                $data = ProfillingBcp::groupBy('sto', 'rating')
                    ->selectRaw('count(*) as count, sto, rating')
                    ->where('sto', $request->sto)
                    ->get();
            }
            if ($request->input('rating') != '') {
                $data = ProfillingBcp::groupBy('sto', 'rating')
                    ->selectRaw('count(*) as count, sto, rating')
                    ->where('rating', $request->rating)
                    ->get();
            }

            return DataTables::of($data)
                ->addColumn('sto', function ($query) {
                    $sto = $query->sto;
                    return
                        '<a href="' . route('profillingbcp.sto', $sto) . '" id="clid_sto">' . $sto . '</a>';
                })
                ->rawColumns(['sto'])
                ->make(true);
        }

        $sto = ProfillingBcp::select('sto')
            ->groupBy('sto')
            ->orderBy('sto', 'asc')
            ->where('witel', $witel)
            ->get();

        return view('profillingbcp.witel', compact('sto'));
    }

    public function showsto(Request $request, $sto)
    {

        if ($request->ajax()) {

            $data = ProfillingBcp::groupBy('clid', 'rating')
                ->selectRaw('count(*) as count, clid, rating')
                ->where('sto', $sto)
                ->get();

            if ($request->input('rating') != '') {
                $data = ProfillingBcp::groupBy('clid', 'rating')
                    ->selectRaw('count(*) as count, clid, rating')
                    ->where('rating', $request->rating)
                    ->get();
            }

            return DataTables::of($data)
                ->addColumn('clid', function ($query) {
                    $clid = $query->clid;
                    return
                        '<a href="' . route('profillingbcp.clid', $clid) . '" id="all_clid">' . $clid . '</a>';
                })
                ->rawColumns(['clid'])
                ->make(true);
        }

        return view('profillingbcp.sto');
    }

    public function showclid(Request $request, $clid)
    {

        $clid;
        if ($request->ajax()) {

            $data = ProfillingBcp::where('clid', $clid)
                ->get();

            if ($request->input('rating') != '') {
                $data = ProfillingBcp::where('clid', $clid)
                    ->where('rating', $request->rating)
                    ->get();
            }

            return DataTables::of($data)
                ->make(true);
        }

        return view('profillingbcp.clid', compact('clid'));
    }
}