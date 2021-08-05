<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function institutionAccount()
    {
        return $this->hasOne('App\Models\InstitutionAccount');
    }
    public function assignment()
    {
        return $this->hasOne('App\Models\Assignment');
    }
    
    public function mergeOrCreate($payload)
    {
        if(isset($payload['id'])) {
            $transaction = Transaction::findOrFail($payload['id']);
        } else {
            $transaction = new Transaction;
        }
        
        return  $transaction;
    }
}