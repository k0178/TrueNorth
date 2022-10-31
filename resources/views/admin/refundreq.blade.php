@extends('layout.admin')

@section('content')
<div class="bg-white  mx-5 " style="margin-top: 150px; border-right:1px #f0eeee solid; border-top:1px #f0eeee solid; border-left:1px #f0eeee solid;">
    <a href="" class="d-flex  flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
    <span class="fs-5 fw-semibold text-center w-100">Refund Requests</span>
    </a>
    <div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Username</th>
            <th scope="col">Amount</th>
            <th scope="col">Gcash Number</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>

            <tr>
            <th>1</th>
            <td>johndoe</td>
            <td>PHP 500</td>
            <td>09204197332</td>
            <td>Marked as Refunded</td>
            <td>Deny</td>
            <td>
                {{Form::textArea('refundmsg','',
                ['class'=>'form-control',
                'style'=>'height:50px;',
                'placeholder'=>'Input message here.'
                ])}}
            </td>
            </tr>
        </tbody>
    </table>       
    </div>
</div>
@endsection