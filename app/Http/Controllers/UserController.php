<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
	public function index(){
		$users = User::all();
		return view('user.index',compact('users'));
	}
    public function show(User $user){
    	return view('user.show',compact('user'));
    }
}
