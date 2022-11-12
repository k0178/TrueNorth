<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Funds;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title =  Auth::user()->username ." | Fundings";
        $username = Auth::user()->username;
        $data = Funds::where('uname','=',Auth::user()->username)->orderBy('created_at','DESC')->get();
        $funds = User::where('username',$username)->select('funds')->first();
        
        return view('profile.test', compact('title'))->with('funds',$funds)->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function search(Request $request){
        // $fund = Funds::where('refnum','Like','%'.$request->search.'%')
        //         ->orWhere('type','Like','%'.$request->search.'%')
        //         ->where('uname',Auth::user()->username)
        //         ->first();
        
        //     foreach ($fund as $funds) {
        //     $output.= 
        //     '<tr>
        //         <td>'.$funds->refnum.'</td>
        //     </tr>';
        //     }
            
        //     return response($output);

        if($request->ajax()){

            $output = '';
            $query = $request->get('query');
            if($query != ''){
                $data = Funds::where('refnum','like','%'.$query.'%')
                            ->where('uname', Auth::user()->username)
                            ->get();
            }
            else{
                $data = Funds::where('uname', Auth::user()->username)
                                ->orderBy('id','DESC')
                                ->get();
            }

            $total_row = $data->count();
            if($total_row > 0){
                foreach ($data as $row) {
                    $output .= '
                    <tr>
                        <td>'. $row->id.'</td>
                        <td>'. $row->refnum.'</td>
                        <td>'. $row->uname.'</td>
                    </tr>
                    
                    ';
                }
            }
            else{
                $output = '
                    <tr>
                        <td> No DATA FOUND</td>
                    </tr>
                '; 
            }
            $data = array(
                'table_data'=> $output,
                'total_data'=> $total_row
            );
            echo json_encode($data);
        }
    }
}
