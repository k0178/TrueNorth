<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Admin | User Management";
        $data = User::where('user_type','=',1)
                ->where('user_status','=',1)
                ->get();
        return view('admin.usermanagement', compact('title'))->with('data',$data);
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
    public function update($id)
    {
       
        $data = User::find($id);
        $data->user_status= 0;
        $data->update();

        return back();
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
    
        if($request->ajax()){

            $output = ' ';
            $query = $request->get('query');
            if($query != ''){
                $data =  User::where('fname','like','%'.$query.'%')
                            ->orwhere('lname','like','%'.$query.'%')
                            ->orwhere('username','like','%'.$query.'%')
                            ->get();
            }
            else{
                $data = User::where('user_type','=',1)
                            ->where('user_status','=',1)
                            ->get();
                                    
            }
            

            $total_row = $data->count();
            if($total_row > 0){
                foreach ($data as $row) {
                    $output .= '
                    <tr>
                        <th scope=row>'.$row->id.'</th>
                        <td>'.$row->username.'</td>
                        <td>'.$row->fname.' '.$row->lname.'</td>
                        <td>'.$row->address.'</td>
                        <td>'.number_format($row->funds,2).' PHP</td>
                        <td>'.\Carbon\Carbon::parse($row->created_at)->isoFormat('MMM D, YYYY').'</td>
                        <td><button class ="btn fw-bold text-danger " > BLOCK </button>  </td>
                    </tr>';
                }
            }
            else{
                $output = '
                    <tr>
                        <td colspan=6 class=text-center> NO DATA FOUND</td>
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
