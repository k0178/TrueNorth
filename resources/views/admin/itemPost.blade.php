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
                    {{Form::hidden('id', $data->id)}}
                </div>
                <br>
            </div>
        <fieldset >
            <div class="add-auc-content pb-5 d-flex justify-content-center mb-5">
                <div class="col-5">
                    <div class="row ms-2 pb-2">
                        <a>Product Name</a>
                        {{Form::text('prodName',$data->prodName,['class'=>'form-control','placeholder'=>'Product Name','style'=>'border-radius:0%; background:none; border:none; border-bottom:1px #000000 solid;'])}}
                    </div>
                    <div class="row ms-2 mt-3">
                        <a>Product Details</a>
                        {{Form::textArea('prodDeets',$data->prodDeets,
                        ['class'=>'form-control',
                        'placeholder'=>'Product Details',
                        'style'=>'border:none; background:none; border-radius:0%; border:1px #000000 solid;'])}}
                    </div>
                </div>
                <div class="col-5 ms-5 pe-5">
                    <div class="row ms-2 mb-2">
                        <a>Category</a>
                        {{Form::select('category',[
                            'M' => 'Men', 
                            'W' => 'Women',
                            'A' => 'Accessories',
                            'O' => 'Others'], 
                            $data->category, ['class'=> 'btn mt-1 ms-3','placeholder' => 'Choose Category','style'=>'border-radius:0%; border-bottom:1px #000000 solid;']
                        )}}
                    </div>
                    <div class="row ms-2 mb-2">
                        <a>Type</a>
                        {{Form::select('type',[
                            'T' => 'Tees', 
                            'P' => 'Pants',
                            'S' => 'Shorts',
                            'Sh' => 'Shoes'], 
                            $data->type, ['class'=> 'btn mt-1 mb-2 ms-3','placeholder' => 'Choose Category','style'=>'border-radius:0%; border-bottom:1px #000000 solid;']
                        )}}
                    </div>
                    <div class="row ms-2 mb-2">
                        <a>Condition</a>
                        {{Form::select('cond',[
                            'Pre-Loved' => 'Pre-Loved', 
                            'Brand New' => 'Brand New',
                            'Bulk' => 'Bulk'], 
                            $data->cond, ['class'=> 'btn mt-1 ms-3','placeholder' => 'Choose Category','style'=>'border-radius:0%; border-bottom:1px #000000 solid;']
                        )}}
                    </div>
                    <div class="row ms-2 w-100" style="">
                        <a>Initial Price</a>
                        {{Form::text('initialPrice',$data->initialPrice,
                        ['class'=>'reg form-control mt-1 mb-3 ms-3',
                        'placeholder'=>'Initial Price',
                        'style'=>'border:none; padding:0; background:none; border-radius:0%; border-bottom:1px #000000 solid;'])}}
                    </div>
                    <div class="row ms-2">
                        <a>Buyout Price</a>
                        {{Form::text('buyPrice',$data->buyPrice,
                        ['class'=>'reg form-control mt-1 pt-1 ms-3 my-3',
                        'placeholder'=>'Buy Out Price',
                        'style'=>'border:none; background:none; border-radius:0%; border-bottom:1px #000000 solid;'])}}
                    </div>
                    <div class="row ms-2" style="">
                        <a>Quantity</a>
                        {{Form::number('qty',$data->qty,
                        ['class'=>'reg form-control mt-1 mb-3 ms-3',
                        'placeholder'=>'Quantity',
                        'style'=>'border:none; background:none; border-radius:0%; border-bottom:1px #000000 solid;'])}}
                    </div>
                </div>
                </fieldset> 
             
                    <div class="d-flex text-center justify-content-center align-items-center w-100">
                        <label class="me-2">End Date:</label>
                        {{ Form::date('endDate', \Carbon\Carbon::now(), ['class' => 'w-25 form-control ']) }}
                    </div>
                    <div class="d-flex justify-content-center mt-5 ">
                        {{Form::submit('Post Item',['class'=>'btn btn-dark w-25 mb-5','style'=>'border-radius:0%;'])}}
                    </div>
                            
                {!! Form::close() !!}
    </div>

    @endsection

    