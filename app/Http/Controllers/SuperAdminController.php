<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
use Symfony\Component\HttpFoundation\Session\Session as HttpFoundationSessionSession;

session_start();

class SuperAdminController extends Controller
{
    public function dashboard(){
        $this->AdminAuthCheck();
        return view('admin.dashboard');
       }

    public function logout(){
        Session::flush();
        return Redirect::to('/adminlogin');
    }

    public function AdminAuthCheck()
    {
        $admin_id = 'Session'::get('admin_id');
        if ( $admin_id){
            return;
        }
        else{
                return Redirect::to('/adminlogin')->send();
        }

    }

}