<?php

namespace App\Http\Controllers\Api\Authorized;

use App\Models\Account;
use App\Models\Institution;
use App\Models\InstitutionCredentials;
use App\Models\InstitutionAccount;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\External\PlaidService;

class InstitutionController extends Controller
{
    private $plaidService;

    public function __construct(){
        $InstitutionController = $this;
        $InstitutionController->plaidService = new PlaidService;
    }

    public function index(){
        $InstitutionController = $this;
        $institutionAccount = InstitutionAccount::all();
        return response()->json($institutionAccount);
    }

    public function create(Request $request){
        $InstitutionController = $this;
        
        $payload = $request->all();

        $currentAccountId = (int) $request->header()['current-account-id'];
        $account = Account::find($currentAccountId);

        $institution = Institution::createFromPayload($payload);
        $account->institutions()->save($institution);

        $accessToken = $InstitutionController->plaidService->exchangePublicToken($payload['public_token']);
        $item = $InstitutionController->plaidService->getItem($accessToken->access_token);
        $institutionCredentials = InstitutionCredentials::createFromPayload($accessToken->access_token, $item->item_id);
        $institution->credentials()->save($institutionCredentials);

        $institutionAccounts = InstitutionAccount::bulkCreate($payload, $currentAccountId, $accessToken->access_token);
        $institution->institutionAccount()->saveMany($institutionAccounts);
        
        $response = new \stdclass;
        $response->institution = $institution;
        $response->institutionAccounts = $institutionAccounts;

        return response()->json($response);
    }

    public function linked(Request $request){
        $InstitutionController = $this;
        $institutionAccounts = InstitutionAccount::whereNotNull('dym_account_id')->get();
        return response()->json($institutionAccounts);
    }

    public function unrelateDymAccount(Request $request){
        $InstitutionController = $this;

        $payload = $request->all();

        $institutionAccount = InstitutionAccount::find($payload['institutionAccountId']);
        $institutionAccount->dym_account_id = null;

        return response()->json($institutionAccount->save());
    }
}