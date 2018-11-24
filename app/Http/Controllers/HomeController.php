<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\user;


class HomeController extends Controller
{
    public function login()
    {
    	return view('backend.login');
    }



    public function postlogin(Request $req)
    {
    	
    	$email= $req->email;
    	$password= $req->password;
    	$obj=User::where('email','=',$email)   
    				->where('password','=',$password)
    				->first();
    
    	if($obj)
    	{
    		Session::put('userid',$obj->id);
    		//return view('backend.dashboard');
    		return redirect('dashboard');

    	}
    	else
    	{
    		return redirect()->back()->with('alert', 'Wrong Email or Password!');

    	}
    }

    public function logout(Request $req)
    {
    	$req->session()->flush();
    	return redirect('login');
    	
    }

     public function registration()
    {
        return view('backend.registration');
    }

    public function store(Request $req)
    {
        $obj = new user();
        $obj->first_name = $req->firstname;
        $obj->last_name = $req->lastname;
         $obj->email = $req->email;
        $obj->password = $req->password;
        if($obj->save())
        {
            return redirect('dashboard');
        }
    }

    public function dashboard()
    {
    	return view('backend.dashboard');
    }

}
