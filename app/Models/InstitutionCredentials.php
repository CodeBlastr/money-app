<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstitutionCredentials extends Model
{
    protected $hidden = ['remote_id','remote_secret'];

    public function institution()
    {
        return $this->belongsTo('App\Models\Institution');
    }

    public function mergeOrCreate($payload)
    {
        if(isset($payload['id'])) {
            $institutionCredentials = InstitutionCredentials::findOrFail($payload['id']);
        } else {
            $institutionCredentials = new InstitutionCredentials;
        }

        return $institutionCredentials;
    }

    public static function createFromPayload($accessToken, $itemId)
    {
        $institutionCredentials = new InstitutionCredentials;
        $institutionCredentials->remote_id = $itemId;
        $institutionCredentials->remote_secret = $accessToken;

        return $institutionCredentials;
    }

    
}