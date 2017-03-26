<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
	public function service(){
    	return $this->belongsTo('App\Service');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
	public function isInfinite(){
		return $this->type == 'I';
	}
	public function isRollingDays(){
        return $this->type == 'R';
    }
    public function isDateRange(){
        return $this->type == 'D';
    }
}
