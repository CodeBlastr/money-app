<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Institution extends Model
{
    public function account()
    {
        return $this->belongsTo('App\Models\Account');
    }

    public function credentials()
    {
        return $this->hasOne('App\Models\InstitutionCredentials');
    }

    public function institutionAccount()
    {
        return $this->hasMany('App\Models\InstitutionAccount');
    }

    public function mergeOrCreate($payload)
    {
        if(isset($payload['id'])) {
            $institution = Institution::findOrFail($payload['id']);
        } else {
            $institution = new Institution;
        }

        return $institution;
    }

    public static function createFromPayload($payload){
        $institution = new Institution;
        $institution->type = 'plaid';
        $institution->name = $payload['institution']['name'];
        return $institution;
    }
}