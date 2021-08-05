<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public function users(){
        return $this->belongsToMany('App\Models\User')->using('App\Models\AccountUser');
    }

    public function institutions()
    {
        return $this->hasMany('App\Models\Institution');
    }

    public function bankAccounts()
    {
        return $this->hasMany('App\Models\BankAccount');
    }

    public function defenses()
    {
        return $this->hasMany('App\Models\Defense');
    }
}
