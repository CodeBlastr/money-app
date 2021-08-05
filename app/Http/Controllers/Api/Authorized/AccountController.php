<?php

namespace App\Http\Controllers\Api\Authorized;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    public function index()
    {
        $account = Auth::user()->current_account;

        return response()->json($account);
    }
}
