<?php

namespace App\Http\Controllers;

use App\Models\Customer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;

use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
//    public function registration(Request $request){
//       $data = array();
//       $data ['name'] = $request->name;
//       $data ['email'] = $request->email;
//       $data ['mobile'] = $request->mobile;
//       $data ['password'] = $request->password;
//       $id = Customer::insertGetId($data);
//       Session::put('id',$id);
//       Session::put('name',$request->name);
//       return Redirect::to('/checkout');
//    }


public function registration(Request $request)
    {
         
        $validatedData = $request->validate([
          'name' => 'required',
          'email' => 'required',
          'mobile' => 'required',
          'password' => 'required',
        ]);
 
        $emp = new Customer;
 
        $emp->name = $request->name;
        $emp->email = $request->email;
        $emp->mobile = $request->mobile;
        $emp->password = $request->password;
 
        $emp->save();
 
        return redirect('/login-check')->with('message','Account created!');;
 
    }

   public function login(Request $request){
    $email=$request->email;
    $password=$request->password;
    $result=Customer::where('email',$email)->where('password',$password)->first();

    if($result){

        Session::put('id', $result->id);
        Session::put('name', $result->name);
        return redirect('/checkout');
    }
    else{
        Session::put('message', 'Invalid info');
        return redirect('/login-check')->with('message','Invalid Credential!');
        // return Redirect::to('/adminlogin');
    }

   

}

public function logout(){
    Session::flush();
    return redirect('/');
}
}





