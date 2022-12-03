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
                            <div class="up-photo mb-3" style="padding-top: 5px; ">
                            <h4> <label for="uploadpic">Upload 1st Item Picture (Front View)</label></h4>
                                {{Form::file('itemImg',['class'=>'form-control w-75','required'])}}
                            </div>

                            <div class="up-photo mb-3" style="padding-top: 5px; ">
                                <h4> <label for="uploadpic">Upload 2nd Item Picture (Back View)</label></h4>
                                {{Form::file('itemImg2',['class'=>'form-control w-75'])}}
                            </div>

                            <div class="up-photo mb-3" style="padding-top: 5px; ">
                                <h4> <label for="uploadpic">Upload 3rd Item Picture</label></h4>
                                {{Form::file('itemImg3',['class'=>'form-control w-75'])}}
                            </div>
                    </div>

                    <div class="add-auc-content pb-5 d-flex justify-content-center ">
                        <div class="col-5">
                            <div class="row ms-2 pb-2">
                                <label style="font-size: small;">Product Name</label>
                                {{Form::text('prodName','',['class'=>'form-control','placeholder'=>'Product Name','required'])}}
                            </div>
                            <div class="row ms-2 mt-3">
                                <label style="font-size: small;">Product Details</label>
                                {{Form::textArea('prodDeets','',
                                ['class'=>'form-control',
                                'placeholder'=>'Product Details',
                                'required'
                                ])}}
                            </div>
                        </div>
                        <div class="col-5 ms-5 pe-5">
                            <div class="row ms-2 mb-2">
                                <label style="font-size: small;">Category</label>
                                {{Form::select('category',[
                                    'M' => 'Men', 
                                    'W' => 'Women',
                                    'A' => 'Assorted (Bulk)',
                                    'O' => 'Others'], 
                                    null, ['class'=> 'btn btn-white border-dark dropdown-toggle mt-1 ms-3','placeholder' => 'Choose Category','required']
                                )}}
                            </div>
                            <div class="row ms-2 mb-2">
                                <label style="font-size: small;">Type</label>
                                {{Form::select('type',[
                                    'T' => 'Tops', 
                                    'P' => 'Pants',
                                    'S' => 'Shorts',
                                    ], 
                                    null, ['class'=> 'btn btn-white border-dark dropdown-toggle mt-1 mb-2 ms-3','placeholder' => 'Choose Type','required']
                                )}}
                            </div>
                            <div class="row ms-2 mb-2">
                                <label style="font-size: small;">Condition</label>
                                {{-- {{Form::select('cond',[
                                    'Pre-Loved' => 'Pre-Loved', 
                                    'Brand New' => 'Brand New',
                                    'Bulk' => 'Bulk',
                                    ], 
                                    null, ['class'=> 'btn btn-white border-dark dropdown-toggle mt-1 mb-2 ms-3','placeholder' => 'Choose Condition']
                                )}} --}}

                                <select name="cond" id="cond" onchange="showMe(this.value)" class="btn btn-white border-dark dropdown-toggle mt-1 mb-2 ms-3" required>
                                    <option value="Pre-Loved">Pre-Loved</option>
                                    <option value="Brand New">Brand New</option>
                                    <option value="Bulk">Bulk</option>
                                </select> 
                                
                                {{-- {!! Form::select('cond', [
                                    'Pre-Loved' => 'Pre-Loved', 
                                    'Brand New' => 'Brand New',
                                    'Bulk' => 'Bulk',
                                    ], null, ['name'=>'cond', 'id'=>'cond', 'onchange'=>{{showMe(this.value)}}, 'class'=>'btn btn-white border-dark dropdown-toggle mt-1 mb-2 ms-3']) !!} --}}
                                <div id="bulk" class="" style="display:none;">
                                    <label style="font-size: small;">Weight</label>
                                    {{Form::number('weight','',
                                        ['class'=>' form-control  mt-2 ',
                                        'placeholder'=>'Enter Weight in KG'
                                        ])}}
                                </div>
                                
                                <script>
                                    function showMe(value) {
                                        if(value=="Bulk"){
                                            document.getElementById('bulk').style.display="block";
                                            // document.getElementById('b').style.display="none";
                                        }
                                        else{
                                            document.getElementById('bulk').style.display="none";
                                        }
                                        
                                    }
                                </script>
                            
                            </div>
                            <div class="row ms-2 mt-3 w-100" style="">
                                <label style="font-size: small;">Initial Price</label>
                                {{Form::number('initialPrice','',
                                ['class'=>' form-control  mb-3 ms-3',
                                'placeholder'=>'Initial Price','required'
                                ])}}
                                
                            </div>
                            {{-- <div class="row ms-2">
                                <label style="font-size: small;">Buyout Price</label>
                                {{Form::number('buyPrice','',
                                ['class'=>'form-control mt-1  ms-3 mb-3',
                                'placeholder'=>'Buy Out Price'])}}
                            </div> --}}
                            <div class="row ms-2" style="">
                                <label style="font-size: small;">Quantity</label>
                                {{Form::number('qty','',
                                ['class'=>'form-control mt-1 mb-3 ms-3',
                                'placeholder'=>'Quantity'])}}
                            {{Form::submit('ADD ITEM',['class'=>'form-btn ms-3 mt-3','required'])}}
                            
                            {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endsection

    