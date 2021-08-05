<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{    
    public function account()
    {
        return $this->belongsTo('App\Models\Account');
    }

    public function institutionAccount()
    {
        return $this->hasOne('App\Models\InstitutionAccount');
    }
    
    public function mergeOrCreate($payload)
    {
        if(isset($payload['id'])) {
            $bankAccount = BankAccount::findOrFail($payload['id']);
        } else {
            $bankAccount = new BankAccount;
        }

        return $bankAccount;
    }

    public static function createFromInstitutionAccount($institutionAccountId, $bankAccountType = 1)
    {
        $institutionAccount = InstitutionAccount::findOrFail($institutionAccountId);

        $bankAccount = new BankAccount;
        $bankAccount->institution_id = $institutionAccount->institution_id;
        $bankAccount->account_id = $institutionAccount->account_id;
        $bankAccount->remote_name = $institutionAccount->name;
        $bankAccount->remote_official_name = $institutionAccount->official_name;
        $bankAccount->mask = $institutionAccount->mask;
        $bankAccount->type = $bankAccountType;
        $bankAccount->balance_available = $institutionAccount->balance_available;
        $bankAccount->remote_id = $institutionAccount->institution_id;

        return $bankAccount;
    }
}