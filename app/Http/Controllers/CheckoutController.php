<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Shipping;
use Cart;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;


class CheckoutController extends Controller
{
    public function index(){
        $customer_id =Customer:: where('id',Session::get('id'))->first();
        return view('frontend.pages.checkout');
    }

    public function login_check(){
        return view('frontend.pages.login');
    }

    public function save_shipping_address(Request $request){
        $data = array();
        $data ['name'] = $request->name;
        $data ['email'] = $request->email;
        $data ['mobile'] = $request->mobile;
        $data ['address'] = $request->address;
        $data ['city'] = $request->city;
        $data ['country'] = $request->country;
        $data ['zip_code'] = $request->zip_code;

              $s_id = Shipping::insertGetId($data);
              Session::put('sid',$s_id);
             
              return redirect('/payment');

    }

    public function payment(){

         $cartcollection = Cart::getContent();
         $cart_array = $cartcollection->toArray();
        return view('frontend.pages.payment',compact('cart_array'));
    }

    public function order_place(Request $request){
        $payment_method = $request->payment;

        $pdata = array();
        $pdata['payment_method'] =$payment_method ;
        $pdata['status'] ='pending';

        $payment_id = Payment::insertGetId($pdata);

        $odata = array();
        $odata['cus_id']=Session::get('id');
        $odata['ship_id']=Session::get('sid');
        $odata['pay_id']=$payment_id;
        $odata['total']=Cart::getTotal()+50;
        $odata['status'] ='pending';
        $order_id = Order::insertGetId($odata);

        $cartcollection = Cart::getContent();
        $oddata = array();
        Foreach ($cartcollection as $cartcontent){
            $oddata['order_id']=$order_id;
            $oddata['product_id']=$cartcontent->id;
            $oddata['product_name']=$cartcontent->name;
            $oddata['product_price']=$cartcontent->price;
            $oddata['product_sales_quantity']=$cartcontent->quantity;

            // $orderd_id = OrderDetail::insertGetId($oddata);
            DB::table('order_details')->insert($oddata);

        }

        if($payment_method == 'cash'){
            Cart::clear();
            return view('frontend.pages.payment_method');
        }elseif($payment_method == 'bkash'){
            Cart::clear();
            return view('frontend.pages.payment_method');
        }elseif($payment_method == 'nogod'){
            Cart::clear();
            return view('frontend.pages.payment_method');
        }

    }

   
}
