<?php

namespace App\Http\Controllers;

use App\Service;
use App\User;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
	public function show(User $user, $serviceLink){
		$service = $user->services()->where('link',$serviceLink)->first();
		if (!$service)
    		abort(404);
    	return view('service.show',compact('service','user'));
    }
}
