@extends('layout.admin')
    @section('content')
 
    <div class="d-flex justify-content-center align-items-center ">
        <div class="add-auc ms-5 my-5 w-75"  style="background-color:#f0eeee;">
                    <div class="ms-2 mt-3  py-4">
                        <h2 class="px-5"><b>Add Item</b></h2>
                    </div>
                    {!! Form::open(['action'=>'App\Http\Controllers\InventoryController@store',
                    'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
                    <div class="mb-3 px-3" style="width: 500px; margin-left:70px" >
                        <div class="py-1">
                            <i class="bi bi-file-image" style="font-size: 90px;"></i>
                        </div>
                        <br>
                            <div class="up-photo" style="padding-top: 5px; ">
                            <h4> <label for="uploadpic">Upload Item Picture</label></h4>
                                {{Form::file('itemImg',['class'=>'form-control w-75'])}}
                            </div>
                    </div>

                    <div class="add-auc-content pb-5 d-flex justify-content-center ">
                        <div class="col-5">
                            <div class="row ms-2 pb-2">
                                <label style="font-size: small;">Product Name</label>
                                {{Form::text('prodName','',['class'=>'form-control','placeholder'=>'Product Name'])}}
                            </div>
                            <div class="row ms-2 mt-3">
                                <label style="font-size: small;">Product Details</label>
                                {{Form::textArea('prodDeets','',
                                ['class'=>'form-control',
                                'placeholder'=>'Product Details'
                                ])}}
                            </div>
                        </div>
                        <div class="col-5 ms-5 pe-5">
                            <div class="row ms-2 mb-2">
                                <label style="font-size: small;">Category</label>
                                {{Form::select('category',[
                                    'M' => 'Men', 
                                    'W' => 'Women',
                                    'A' => 'Accessories',
                                    'O' => 'Others'], 
                                    null, ['class'=> 'btn btn-white border-dark dropdown-toggle mt-1 ms-3','placeholder' => 'Choose Category']
                                )}}
                            </div>
                            <div class="row ms-2 mb-2">
                                <label style="font-size: small;">Type</label>
                                {{Form::select('type',[
                                    'T' => 'Tees', 
                                    'P' => 'Pants',
                                    'S' => 'Shorts',
                                    ], 
                                    null, ['class'=> 'btn btn-white border-dark dropdown-toggle mt-1 mb-2 ms-3','placeholder' => 'Choose Type']
                                )}}
                            </div>
                            <div class="row ms-2 mb-2">
                                <label style="font-size: small;">Condition</label>
                                {{Form::select('cond',[
                                    'Pre-Loved' => 'Pre-Loved', 
                                    'Brand New' => 'Brand New',
                                    'Bulk' => 'Bulk',
                                    ], 
                                    null, ['class'=> 'btn btn-white border-dark dropdown-toggle mt-1 mb-2 ms-3','placeholder' => 'Choose Condition']
                                )}}
                            </div>
                            <div class="row ms-2 w-100" style="">
                                <label style="font-size: small;">Initial Price</label>
                                {{Form::number('initialPrice','',
                                ['class'=>' form-control  mb-3 ms-3',
                                'placeholder'=>'Initial Price'
                                ])}}
                            </div>
                            <div class="row ms-2">
                                <label style="font-size: small;">Buyout Price</label>
                                {{Form::number('buyPrice','',
                                ['class'=>'form-control mt-1  ms-3 mb-3',
                                'placeholder'=>'Buy Out Price'])}}
                            </div>
                            <div class="row ms-2" style="">
                                <label style="font-size: small;">Quantity</label>
                                {{Form::number('qty','',
                                ['class'=>'form-control mt-1 mb-3 ms-3',
                                'placeholder'=>'Quantity'])}}
                                {{Form::submit('ADD ITEM',['class'=>'btn btn-dark ms-3 mt-3','style'=>'border-radius:0%;'])}}
                            </div>
                            
                                   
                            
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
    @endsection

    