<?php

namespace App\Models\BankAccount;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public function bankAccount()
    {
        return $this->belongsTo('App\Models\BankAccount');
    }
    
    public function items()
    {
        return $this->hasMany('App\Models\BankAccount\Schedule\Items');
    }

    public function mergeOrCreate($payload)
    {
        if(isset($payload['id'])) {
            $schedule = Schedule::findOrFail($payload['id']);
        } else {
            $schedule = new Schedule;
        }

        return $schedule;
    }
}