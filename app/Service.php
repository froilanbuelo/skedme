<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function schedules(){
        return $this->hasMany('App\Schedule');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function getRouteKeyName(){
        return 'link';
    }
    public function getServiceSchedules(){
        if ($this->schedules()->count() > 0){
            $schedules = $this->schedules;
        }else{
            $schedules = $this->user->schedules()->where('service_id', NULL)->get();;
        }
        return $schedules;
    }
    
    public function getWeekAvailability($startDate = null){
    	if (!$startDate){
    		$startDate = Carbon::now()->toDateString();
    	}
    	if ($this->schedules()->count() > 0){
    		$schedules = $this->schedules;
    	}else{
    		$schedules = $this->user->schedules()->where('service_id', NULL)->get();;
    	}
    	return $schedules;
    }
}
