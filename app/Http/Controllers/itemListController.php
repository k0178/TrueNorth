<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class itemListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data = Inventory::all();
        $title = "Admin | Item List";
        if(Auth::user()->user_type == 1){
            return redirect('/home');
        }
        else{
            return view('admin.itemList', compact('title'))->with('data',$data);
            }
        
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
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Edit Item';
        $data= Inventory::find($id);
        if(Auth::user()->user_type == 1){
            return redirect('/home');
        }
        else{
            return view('admin.editItem',compact('title'))->with('data',$data);
            }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = Inventory::find($id);

        $input->prodName=$request->prodName;
        $input->prodDeets=$request->prodDeets;
        $input->category=$request->category;
        $input->type=$request->type;
        $input->initialPrice=$request->initialPrice;
        $input->buyPrice=$request->buyPrice;
        $input->cond=$request->cond;
        $input->qty=$request->qty;

        $input->save();


        return redirect('/admin/list')->with('success','Item Updated. ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $drop=Inventory::where('id',$request->product_id);
        $drop->delete();
        return redirect('/admin/list')->with('success','Item Deleted');
    }

    public function search(Request $request){
    
        if($request->ajax()){

            $output = '';
            $query = $request->get('query');
            if($query != ''){
                $data =  Inventory::where('id','like','%'.$query.'%')
                            ->orwhere('prodName','like','%'.$query.'%')
                            ->get();
            }
            else{
                $data = Inventory::orderBy('created_at','DESC')
                            ->get();
                                    
            }
            

            $total_row = $data->count();
            if($total_row > 0){
                foreach ($data as $row) {
                    $qty = '';
                    if ($row->qty == 0 ) {
                        $qty.='
                            <span class="badge text-bg-danger d-flex align-items-center"><i class="text-white me-2 bi bi-exclamation-circle-fill"></i>Out of Stock</span>
                        ';
                    }
                    else{
                        $qty.='

                        <form action = "/postItem/'.$row->id.'" method="GET">
                            <button type="sumbit" class="btn text-success d-flex">
                                    <i class="bi bi-plus-circle-fill me-2 text-success" style=""></i>
                                    POST ITEM
                            </button>
                        </form>
                        ';
                    }

                    $weight='';
                    if($row->cond == 'Bulk'){
                        $weight .='<li>Weight: <b>'.number_format($row->weight,2).' KG</b></li>';
                    }
                    else{
                        $weight .=' ';
                    }

                    $output .= '
                    <div class="list-group list-group-flush scrollarea mx-3 " style="border-bottom:1px #dddddd solid;">
                        <div class="d-flex align-items-center">
                            <img src="/itemImages/'.$row->itemImg.' "width="160px" height="160px" 
                            style="object-fit: cover; 
                                    border:3px #393E41 solid; 
                                    " 
                            class="rounded-circle ">
                            <div class="pt-3">
                                <ul style="list-style: none;">
                                    <li>#<b>'.$row->id.'</b></li>
                                    <li class="d-flex align-items-center " style="text-overflow: ellipsis;"><h3><b>'.$row->prodName.'</b></h3>
                                    '.$qty.'
                                        <form action = "/deleteitem" method="GET">
                                            <input type = "hidden" name="product_id" value="'.$row->id.'">
                                            <button type="submit" class="btn mb-2 ms-2 d-flex" style="font-size:18px;" >
                                                <i class="bi bi-trash-fill " style="color:#C76D6D;"></i>
                                            </button>
                                        </form>
                                
                                        <button type="button" class="btn mb-2 ms-2 text-dark d-flex" 
                                            onclick=location.href="list/'.$row->id.'/edit" style="font-size:18px;" >
                                            <i class="bi bi-pencil-square" style="color:#393E41;"></i>
                                        </button>
                                    </li>
                                    <li>Type: <b>'.$row->type.'</b></li>
                                    <li>Category: <b>'.$row->category.'</b></li>
                                    <li>Condition: <b>'.$row->cond.'</b></li>
                                    '.$weight.'
                                    <li>Stock: <b>'.$row->qty.'</b></li>
                                    <li>Starting Price: <b>'. number_format($row->initialPrice,2).' PHP</b></li>
                                    
                                    <button class="form-btn my-3 " style="background: #D3D0CB;" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop'.$row->id.'">
                                        SHOW DETAILS
                                    </button>
                                    
                                    <div class="modal fade" id="staticBackdrop'.$row->id.'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">'.$row->prodName.' Details </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    '.$row->prodDeets.'
                                                </div>
                                                
                                                <div class="modal-footer justify-content-center  align-items-center">
                                                    <button type="button" class="info-btn" data-bs-dismiss="modal">GOT IT</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>';
                }
            }
            else{
                $output = '
                        <div class= w-100 text-center> NO DATA FOUND</div>
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
