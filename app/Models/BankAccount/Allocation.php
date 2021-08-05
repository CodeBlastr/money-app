<?php

namespace App\Models\BankAccount;

use Illuminate\Database\Eloquent\Model;

class Allocation extends Model
{
    public function bankAccount(){
        return $this->hasOne('App\Models\BankAccount');
    }

    public function defense()
    {
        return $this->belongsTo('App\Models\Defense'); 
    }

    public function mergeOrCreate($payload)
    {
        if(isset($payload['id'])) {
            $allocation = Allocation::findOrFail($payload['id']);
        } else {
            $allocation = new Allocation;
        }
        
        return  $allocation;
    } 
}