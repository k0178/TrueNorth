@extends('layout.admin')
    @section('content')
    <div class="add-auc m-auto w-75 "  style="background-color:#f0eeee; margin-top: 150px;">
       
            <div class="ms-2 mt-3  py-4">
                <h2 class="px-5"><b>Edit Item</b></h2>
            </div>
            {!! Form::open(['action'=>['App\Http\Controllers\itemListController@update',$data->id],
            'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
            <div class="mb-3 px-3" style="width: 500px; margin-left:70px" >
                <div class="py-1">
                    <img src="/itemImages/{{$data->itemImg}}" width="150px" height="150px" >
                </div>
                <br>
                    {{-- <div class="up-photo" style="padding-top: 5px; ">
                       <h4> <label for="uploadpic">Upload Item Picture</label></h4>
                        {{Form::file('itemImg',['class'=>'form-control'])}}

                    </div> --}}
              </div>

            <div class="add-auc-content pb-5 d-flex justify-content-center mb-5">
                <div class="col-5">
                    <div class="row ms-2 pb-2">
                        <label>Product Name</label>
                        {{Form::text('prodName',$data->prodName,['class'=>'form-control','placeholder'=>'Product Name','readonly'])}}
                    </div>
                    <div class="row ms-2 mt-3">
                        <label>Product Details</label>
                        {{Form::textArea('prodDeets',$data->prodDeets,
                        ['class'=>'form-control',
                        'placeholder'=>'Product Details',
                        'readonly'])}}
                    </div>
                </div>
                <div class="col-5 ms-5 pe-5">
                    <div class="row ms-2 mb-2">
                        <label>Category</label>
                        {{Form::select('category',[
                            'M' => 'Men', 
                            'W' => 'Women',
                            'A' => 'Accessories',
                            'O' => 'Others'], 
                            $data->category, ['class'=> 'btn mt-1 ms-3','placeholder' => 'Choose Category']
                        )}}
                    </div>
                    <div class="row ms-2 mb-2">
                        <label>Category</label>
                        {{Form::select('type',[
                            'T' => 'Tees', 
                            'P' => 'Pants',
                            'S' => 'Shorts',
                            'Sh' => 'Shoes'], 
                            $data->type, ['class'=> 'btn mt-1 mb-2 ms-3','placeholder' => 'Choose Category']
                        )}}
                    </div>
                    <div class="row ms-2 mb-2">
                        <label>Condition</label>
                        {{Form::select('cond',[
                            'Pre-Loved' => 'Pre-Loved', 
                            'Brand New' => 'Brand New',
                            'Bulk' => 'Bulk'], 
                            $data->cond, ['class'=> 'btn mt-1 ms-3','placeholder' => 'Choose Category']
                        )}}
                    </div>
                    <div class="row ms-2 mt-3 w-100" style="">
                        <label>Initial Price</label>
                        {{Form::text('initialPrice',$data->initialPrice,
                        ['class'=>'form-control mt-1 mb-3 ms-3',
                        'placeholder'=>'Initial Price',
                        'readonly'])}}
                    </div>
                    {{-- <div class="row ms-2">
                        <label>Buyout Price</label>
                        {{Form::text('buyPrice',$data->buyPrice,
                        ['class'=>'reg form-control mt-1 pt-1 ms-3 my-3',
                        'placeholder'=>'Buy Out Price',
                        'style'=>'border:none; background:none; border-radius:0%; border-bottom:1px #000000 solid;'])}}
                    </div> --}}
                    <div class="row ms-2" style="">
                        <label>Quantity</label>
                        {{Form::number('qty',$data->qty,
                        ['class'=>'form-control mt-1 mb-3 ms-3',
                        'placeholder'=>'Quantity'
                        ])}}
                    </div>
                    <div class="ms-4 mt-4 text-align-center" style=" width:100%;">
                        <div class="" style="display: inline-block; padding-inline-start:25%;">
                            {{Form::hidden('_method','PUT')}}
                            {{Form::submit('Save Changes',['class'=>'form-btn  w-100 '])}}
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    @endsection

    