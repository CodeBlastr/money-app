<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    public function bankAccount()
    {
        return $this->hasOne('App\Models\BankAccount');
    }
    
    public function transaction()
    {
        return $this->belongsTo('App\Models\Transaction');
    }

    public function mergeOrCreate($payload)
    {
        if(isset($payload['id'])) {
            $assignment = Assignment::findOrFail($payload['id']);
        } else {
            $assignment = new Assignment;
        }
        
        return  $assignment;
    }
}