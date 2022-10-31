<?php

namespace App\Http\Controllers;

Use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
Use Illuminate\Support\Facades\Redirect;


session_start();
class AdminController extends Controller
{
    public function admin(){
        return view('admin.admin_login');
       }

    


       public function show_dashboard(Request $request){
        $admin_email=$request->email;
        $admin_password=md5($request->password);
        $result=Admin::where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();

        if($result){

            Session::put('admin_id', $result->admin_id);
            Session::put('admin_name', $result->admin_name);
            return Redirect::to('/dashboard');
        }
        else{
            Session::put('message', 'Invalid info');
            return redirect('/adminlogin')->with('message','Invalid Credential!');
            // return Redirect::to('/adminlogin');
        }
   }
    
}
