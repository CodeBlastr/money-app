<?php

namespace App\Http\Controllers\Api\Authorized;

use App\Models\BankAccount;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    // probably can remove
//    private $plaidService;

    public function __construct(){
        $BankAccountController = $this;
    }

    public function create(Request $request){
        $BankAccountController = $this;

        $payload = $request->all();

        $bankAccount = BankAccount::createFromInstitutionAccount($payload['institutionAccountId'], $payload['bankAccountTypeId']);
        $bankAccount->save((array) $bankAccount);

        $response = new \stdclass;
        $response->bankAccount = $bankAccount;

        return response()->json($response);
    }

}