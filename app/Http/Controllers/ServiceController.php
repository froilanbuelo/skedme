<?php

namespace App\Http\Controllers;

use App\Service;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
	public function show(User $user, $serviceLink){
		$service = $user->services()->where('link',$serviceLink)->first();
		if (!$service)
    		abort(404);
    	$availabilities = $this->getWeekAvailability($service);
    	return view('service.show',compact('service','user','availabilities'));
    }
    public function getWeekAvailability($service, $startDate = ''){
    	$availabilityArray = array();
    	for ($date = Carbon::now(); $date <= Carbon::now()->addDays(7); $date = $date->addDay()){
			$availabilityArray[$date->format('l')]['date'] = $date->toDateString();
			$availabilityArray[$date->format('l')]['slotCount'] = 0;
			$availabilityArray[$date->format('l')]['slots'] = array();
		}
		$scheduleList = $service->getServiceSchedules();
		foreach($scheduleList as $schedule){
			if ($schedule->isInfinite()){
				$startTime = Carbon::parse(Date('Y-m-d').' '.$schedule->time_start);
				$endTime = Carbon::parse(Date('Y-m-d').' '.$schedule->time_end);
				$durationHours = $service->hours;
				$durationMinutes = $service->minutes;
				while ($startTime <= $endTime){
					$untilTime = $startTime->copy();
					$untilTime->addHours($durationHours);
					$untilTime->addMinutes($durationMinutes);
					if ($untilTime <= $endTime){
						$availabilityArray[$schedule->day]['slotCount'] += 1;
						$availabilityArray[$schedule->day]['slots'][] = 
							array ('startTime' => $startTime, 'endTime' => $untilTime, 'durationHours' => $durationHours, 'durationMinutes' => $durationMinutes);
					} // if
					$startTime = $untilTime->copy();
				} // while
			}else if ($schedule->isRollingDays()){
				$rollingDays = $schedule->rolling_days;
				for ($ctr = 0; $ctr < $rollingDays && $ctr < 7; $ctr ++){
					$date = Carbon::now()->addDays($ctr);
					if ($schedule->day == $date->format('l')){
						$startTime = Carbon::parse(Date('Y-m-d').' '.$schedule->time_start);
						$endTime = Carbon::parse(Date('Y-m-d').' '.$schedule->time_end);
						$durationHours = $service->hours;
						$durationMinutes = $service->minutes;
						while ($startTime <= $endTime){
							$untilTime = $startTime->copy();
							$untilTime->addHours($durationHours);
							$untilTime->addMinutes($durationMinutes);
							if ($untilTime <= $endTime){
								$availabilityArray[$schedule->day]['slotCount'] += 1;
								$availabilityArray[$schedule->day]['slots'][] = 
									array ('startTime' => $startTime, 'endTime' => $untilTime, 'durationHours' => $durationHours, 'durationMinutes' => $durationMinutes);
							} // if
							$startTime = $untilTime->copy();
						} // while
					} //if
				} //for
			}else if ($schedule->isDateRange()){
				$startDate = Carbon::parse($schedule->date_start);
				$endDate = Carbon::parse($schedule->date_end);
				for ($date = Carbon::now(); $date >= $startDate && $date <= $endDate && $date < Carbon::now()->addDays(7); $date = $date->addDay()){
					if ($schedule->day == $date->format('l')){
						$startTime = Carbon::parse(Date('Y-m-d').' '.$schedule->time_start);
						$endTime = Carbon::parse(Date('Y-m-d').' '.$schedule->time_end);
						$durationHours = $service->hours;
						$durationMinutes = $service->minutes;
						while ($startTime <= $endTime){
							$untilTime = $startTime->copy();
							$untilTime->addHours($durationHours);
							$untilTime->addMinutes($durationMinutes);
							if ($untilTime <= $endTime){
								$availabilityArray[$schedule->day]['slotCount'] += 1;
								$availabilityArray[$schedule->day]['slots'][] = 
									array ('startTime' => $startTime, 'endTime' => $untilTime, 'durationHours' => $durationHours, 'durationMinutes' => $durationMinutes);
							} // if
							$startTime = $untilTime->copy();
						} // while
					} //if
				}
			}
		} //foreach
		return $availabilityArray;
    } //function
}
