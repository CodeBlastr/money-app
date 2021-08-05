<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\External\PlaidService;

class InstitutionAccount extends Model
{
    public function institution()
    {
        return $this->belongsTo('App\Models\InstitutionCredentials');
    }

    public function mergeOrCreate($payload)
    {
        if(isset($payload['id'])) {
            $institutionAccount = InstitutionAccount::findOrFail($payload['id']);
        } else {
            $institutionAccount = new InstitutionAccount;
        }

        return $institutionAccount;
    }


    public static function bulkCreate($payload, $currentAccountId, $accessToken){
        $allInstitutionAccounts = [];

        $plaidService = new PlaidService;
        foreach($payload['accounts'] as $account){
            $plaidAccount = $plaidService->getAccountsBalance($accessToken, [$account['id']]);
            $institutionAccount = new InstitutionAccount;
            $institutionAccount->name = $account['name'];
            $institutionAccount->official_name = $plaidAccount[0]->official_name;
            $institutionAccount->account_id = $currentAccountId;
            $institutionAccount->balance_available = $plaidAccount[0]->balances->available;
            $institutionAccount->balance_current = $plaidAccount[0]->balances->current;
            $institutionAccount->balance_limit = $plaidAccount[0]->balances->limit;
            $institutionAccount->iso_currency_code = $plaidAccount[0]->balances->iso_currency_code;
            $institutionAccount->mask = $account['mask'];
            
            $allInstitutionAccounts[] = $institutionAccount;
        }
        return $allInstitutionAccounts;
    }    
}