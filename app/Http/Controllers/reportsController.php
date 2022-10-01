<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Inventory;
use App\Models\Funds;
use Barryvdh\DomPDF\Facade\Pdf;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class reportsController extends Controller
{
    public function index()
    {
        $title = "Admin | Reports";
        return view('admin.reports',compact('title'));
    }

    public function invreport()
    {   
        $title = "Admin | Inventory Reports";
        $data = Inventory::orderBy('category','desc')->get();
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
}
