<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Inventory;
use App\Models\Funds;
use App\Models\Biddings;
use App\Models\Refund;
use Barryvdh\DomPDF\Facade\Pdf;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class reportsController extends Controller
{
    public function index()
    {   
        $look = Biddings::orderBy('prodname')
        ->orderByRaw('COUNT(*)DESC')
        ->limit(1)
        ->get();

        $val=$look[0]->prodname;

        $hotItem = Inventory::where('prodName','=',$val)->get();

        $data = Funds::orderBy('created_at','desc')
        ->where('status','=','approved')
        ->get();

        $rfnd = Refund::orderBy('created_at','desc')
        ->where('status','=','Refunded')
        ->get();

        $title = "Admin | Reports";
        return view('admin.reports',compact('title'))->with('hotItem',$hotItem)
        ->with('data',$data)
        ->with('refund',$rfnd);




    }

    public function invreport()
    {   
        $title = "Admin | Inventory Reports";
        $data = Inventory::orderBy('category','desc')->get();
        // $maxbid_item = Biddings::select('*')->max('bidamt')->first();
        // $maxbid_item = Biddings::select('prodname, bidamt')
        //     ->max('bidamt');
        return view('reports.invRep',compact('title'))->with('data',$data);
        // $pdf = Pdf::loadView('reports.invRep');
        // return $pdf->stream();
    }

    public function fndreport(Request $request)
    {   
        $from = $request->from.' 00.00.00';
        $to = $request->to.' 00.00.00';
        $title = "Admin | Fund Reports";
        $data = Funds::orderBy('created_at','desc')
        ->where('status','=','approved')
        ->where('created_at','>=',$from)
        ->where('created_at','<=',$to)
        ->get();
        return view('reports.fndRep',compact('title'))->with('data',$data);
    }

    public function rfdreport(Request $request)
    {   
        $from = $request->from.' 00.00.00';
        $to = $request->to.' 00.00.00';
        $title = "Admin | Fund Reports";
        $data = Refund::orderBy('created_at','desc')
        ->where('status','=','Refunded')
        ->where('created_at','>=',$from)
        ->where('created_at','<=',$to)
        ->get();
        return view('reports.rfdRep',compact('title'))->with('data',$data);
    }
}
