<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Inventory;
use App\Models\Funds;
use App\Models\Biddings;
use App\Models\Refund;
use Barryvdh\DomPDF\Facade\Pdf;
use Session;
use Response;


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
        $title = "Admin | Item Reports";
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
        $to = $request->to.' 23.59.59';
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
        $to = $request->to.' 23.59.59';
        $title = "Admin | Fund Reports";
        $data = Refund::orderBy('created_at','desc')
        ->where('status','=','Refunded')
        ->where('created_at','>=',$from)
        ->where('created_at','<=',$to)
        ->get();
        return view('reports.rfdRep',compact('title'))->with('data',$data);
    }

    public function exportinv(){


        $data = Inventory::all();
        $columns = array('Name','Details','Condition','Category','Type','Added At');

            $file = fopen('inv.csv', 'w');

            fputcsv($file, $columns);

            foreach ($data as $task) {
                $row['Name']  = $task->prodName;
                $row['Details']    = $task->prodDeets;
                $row['Condition']    = $task->cond;
                $row['Category']  = $task->category;
                $row['Type']  = $task->type;
                $row['Added At']  = $task->created_at;

                fputcsv($file, array($row['Name'], $row['Details'], $row['Condition'], $row['Category'], $row['Type'],$row['Added At']));
            }

            fclose($file);

            $filepath = public_path('/inv.csv');
            return Response::download($filepath); 

   Session::flash('success', "CSV Generated. Check Root Folder");
   return back();

    }

    public function exportfnd(){

     
             $data = Funds::all();
             $columns = array('Username', 'Reference #', 'Amount', 'Type', 'Requested At', 'Total');
     
                 $file = fopen('fund.csv', 'w');
     
                 fputcsv($file, $columns);
                    $total = 0;
                 foreach ($data as $task) {
                     $row['Username']  = $task->uname;
                     $row['Reference #']    = $task->refnum;
                     $row['Amount']    = $task->amount;
                     $row['Type']  = $task->type;
                     $row['Requested At']  = $task->created_at;

                     $total = $total + $task->amount;

                     fputcsv($file, array($row['Username'],$row['Reference #'], $row['Amount'], $row['Type'], $row['Requested At']));
                 }
                 $row['Total'] = $total;
                 $row['Username']  = "/";
                 $row['Reference #']    = "/";
                $row['Amount']    = "/";
                $row['Type']  = "/";
                $row['Requested At']  = "/";
                 fputcsv($file, array($row['Username'],$row['Reference #'], $row['Amount'], $row['Type'], $row['Requested At'],$row['Total']));
                 fclose($file);
     
                 $filepath = public_path('/fund.csv');
                 return Response::download($filepath); 
     
        Session::flash('success', "CSV Generated. Check Root Folder");
        return back();
     
         }

         public function exportrfd(){

     
            $data = Refund::all();
            $columns = array('Username', 'Gcash #', 'Amount', 'Requested At', 'Total');
    
                $file = fopen('refund.csv', 'w');
    
                fputcsv($file, $columns);
                   $total = 0;
                foreach ($data as $task) {
                    $row['Username']  = $task->uname;
                    $row['Gcash #']    = $task->gcashnum;
                    $row['Amount']    = $task->amount;
                    $row['Requested At']  = $task->created_at;

                    $total = $total + $task->amount;

                    fputcsv($file, array($row['Username'],$row['Gcash #'], $row['Amount'], $row['Requested At']));
                }
                $row['Total'] = $total;
                $row['Username']  = "/";
                $row['Gcash #']    ="/";
                $row['Amount']    = "/";
                $row['Requested At']  = "/";

                fputcsv($file, array($row['Username'],$row['Gcash #'], $row['Amount'], $row['Requested At'],$row['Total']));
                fclose($file);
    
                $filepath = public_path('/refund.csv');
                return Response::download($filepath); 
    
       Session::flash('success', "CSV Generated. Check Root Folder");
       return back();
    
        }
}
