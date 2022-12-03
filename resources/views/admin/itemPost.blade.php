@extends('layout.admin')
    @section('content')
    <div class="mx-5 justify-content-center"  style="margin-top:15%; background-color:#f0eeee;">
            <div class="ms-2 mt-3  py-4">
                <h2 class="px-5"><b>Post Item</b></h2>
            </div>
            {!! Form::open(['action'=>['App\Http\Controllers\AuctionController@store',$data->id],
            'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
            <div class="mb-3 px-3" style="width: 500px; margin-left:70px" >
                <div class="py-1">
                    <img src="/itemImages/{{$data->itemImg}}" width="150px" height="150px" >
                    {{Form::hidden('itemImg', $data->itemImg)}}
                    {{Form::hidden('itemImg2', $data->itemImg2)}}
                    {{Form::hidden('itemImg3', $data->itemImg3)}}
                    {{Form::hidden('weight', $data->weight)}}
                    {{Form::hidden('id', $data->id)}}
                </div>
                <br>
            </div>
        <fieldset >
            <div class="add-auc-content pb-5 d-flex justify-content-center mb-5">
                <div class="col-5">
                    <div class="row ms-2 pb-2">
                        <label>Product Name</label>
                        {{Form::text('prodName',$data->prodName,['class'=>'form-control fw-bold','placeholder'=>'Product Name','readonly'])}}
                    </div>
                    <div class="row ms-2 mt-3">
                        <label>Product Details</label>
                        {{Form::textArea('prodDeets',$data->prodDeets,
                        ['class'=>'form-control fw-bold',
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
                            $data->category, ['class'=> 'info-btn fw-bold dropdown-toggle mt-1 mb-2 ms-3','readonly']
                        )}}
                    </div>
                    <div class="row ms-2 mb-2">
                        <label>Type</label>
                        {{Form::select('type',[
                            'T' => 'Tees', 
                            'P' => 'Pants',
                            'S' => 'Shorts',
                            'Sh' => 'Shoes'], 
                            $data->type, ['class'=> 'info-btn fw-bold dropdown-toggle mt-1 mb-2 ms-3','readonly']
                        )}}
                    </div>
                    <div class="row ms-2 mb-2">
                        <label>Condition</label>
                        {{Form::select('cond',[
                            'Pre-Loved' => 'Pre-Loved', 
                            'Brand New' => 'Brand New',
                            'Bulk' => 'Bulk'], 
                            $data->cond, ['class'=> 'info-btn fw-bold dropdown-toggle mt-1 ms-3','readonly']
                        )}}

                        {{-- {{{!! Form::select($name, $list, $selected, [$options]) !!}}} --}}
                    </div>
                    <div class="row ms-2 mt-3 w-100" style="">
                        <label>Initial Price</label>
                        {{Form::text('initialPrice', $data->initialPrice,
                        ['class'=>'form-control fw-bold mt-1 mb-3 ms-3',
                        'placeholder'=>'Initial Price','readonly'
                        ])}}
                    </div>
                    {{-- <div class="row ms-2">
                        <label>Buyout Price</label>
                        {{Form::text('buyPrice', $data->buyPrice,
                        ['class'=>'form-control fw-bold mt-1 pt-1 ms-3 my-3',
                        'placeholder'=>'Buy Out Price','readonly'
                        ])}}
                    </div> --}}
                    <div class="row ms-2" style="">
                        <label>Quantity</label>
                        {{Form::number('qty',$data->qty,
                        ['class'=>'form-control fw-bold mt-1 mb-3 ms-3',
                        'placeholder'=>'Quantity','readonly'
                        ])}}
                    </div>
                </div>
                </fieldset> 
                    <div class="d-flex text-center justify-content-center align-items-center w-100">
                        <label class="me-2">End Date:</label>
                        {{ Form::date('endDate', \Carbon\Carbon::now(), ['class' => 'w-25 form-control ']) }}
                    </div>
                    <div align="center" class="mt-5 mx-5">
                            {{Form::submit('Post Item',['class'=>'form-btn mb-3 w-25 ' ])}}
                            
                            {!! Form::close() !!}
                            <br>
                    </div>
                    <div align="center">
                        <button class="info-btn mb-5" onclick="location.href='/admin/list'">Cancel</button>
                    </div>
                    
                </div>

    @endsection

    