<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Funds;
use Omnipay\Omnipay;
use Session;

use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
private $gateway;

public function __construct() {
    $this->gateway = Omnipay::create('PayPal_Rest');
    $this->gateway->setClientId('AdOjwNsuTIeJhGSBj91pw05g_eq9Mse3vEUeUp2syhu7ocEF0F1QGCy4-mOfEqXL4UzWwviAfh49Am7v');
    $this->gateway->setSecret('EORme3MfTHx4ziM-wGhMy5cwoiT2OcNs_t7xnpxTvo64IKqJH4aTtXNPjtRA-UjwpDDk5fB-tjAc1Tq5');
    $this->gateway->setTestMode(true);
    }

    public function memPay(Request $request)
    {
        try {
            $response = $this->gateway->purchase(array(
                'amount'=>1000,
                'currency'=>'PHP',
                'returnURL'=>url('success'),
                'cancelURL'=>url('error')
            ))->send();

            if ($response->isRedirect()) {
                $response->redirect();
            }
            else{
                return $response->getMessage();
            }
        } catch (\Throwable $th) {
            
            return $th;
        }

   }

   public function success(Request $request){
    if ($request->input('paymentId') && $request->input('PayerID')) {
        $transaction = $this->gateway->completePurchase(array(
            'payer_id'=>$request->input('PayerID'),
            'transactionReference'=>$request->input('paymentId')
        ));

        $response = $transaction->send();

        if ($response->isSuccessful()) {
           $arr = $response->getData();

           $data = new Funds;
           $data->uname=Auth::user()->username;
           $data->refnum=$arr['id'];
           $data->type='Membership';
           $data->amount=1000;
           $data->status='Approved';
           $data->save();
   
           User::where('id', Auth::user()->id)
               ->update(['memberpmt'=>'Approved']);

           return redirect('/fundings');
        }
        else{
            return $response->getMessage();
        }
    }
    else{
        return 'Payment Declined!';
    }
   }

   public function error(){
    return redirect('/index');
   }

   public function fndPay(Request $request){
        try {
            Session::put('amount',$request->reqAmt);
            $response = $this->gateway->purchase(array(
                'amount'=>$request->reqAmt,
                'currency'=>'PHP',
                'returnURL'=>url('fndsuccess'),
                'cancelURL'=>url('error')
            ))->send();

            if ($response->isRedirect()) {
                $response->redirect();
            }
            else{
                return $response->getMessage();
            }
        } catch (\Throwable $th) {
            
        return $th;
        }
   }

   public function fndsuccess(Request $request){
    if ($request->input('paymentId') && $request->input('PayerID')) {
        $transaction = $this->gateway->completePurchase(array(
            'payer_id'=>$request->input('PayerID'),
            'transactionReference'=>$request->input('paymentId')
        ));

        $response = $transaction->send();

        if ($response->isSuccessful()) {
           $arr = $response->getData();

           $fndget = User::select('funds')
           ->where('username', Auth::user()->username)
           ->get();
           //add existing value with the requested value
           $add = Session::get('amount');
           $newsum =$fndget['0']->funds + $add;
           //update new value
           $fundup = User::select('funds')
           ->where('username', Auth::user()->username)
           ->update(['funds'=>$newsum]);

           $data = new Funds;
           $data->uname=Auth::user()->username;
           $data->refnum=$arr['id'];
           $data->type='Fund';
           $data->amount=$add;
           $data->status='Approved';
           $data->save();
   
           return redirect('/fundings');
        }
        else{
            return $response->getMessage();
        }
    }
    else{
        return 'Payment Declined!';
    }
   }

}

