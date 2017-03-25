<?php

namespace App\Domain;

use App\Service;
use Carbon\Carbon;

class ServiceScheduler
{
    protected $service;
    public function __construct(Service $service){
        $this->service = $service;
    }
    public function getWeekAvailability($startDate = null){
    	if (!$startDate){
    		$startDate = Carbon::now()->toDateString();
    	}
    	if ($service->schedules()->count() > 0){
    		$schedules = $service->schedules;
    	}else{
    		$schedules = $service->user->schedules()->where('service_id', NULL)->get();;
    	}
    	return $schedules;
    }
}
