<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Defense extends Model
{
    public function accounts()
    {
        return $this->belongsTo('App\Models\Account');
    }
    
    public function mergeOrCreate($payload)
    {
        if(isset($payload['id'])) {
            $defense = Defense::findOrFail($payload['id']);
        } else {
            $defense = new Defense;
        }

        return $defense;
    }
}