<?php

namespace App\Models\BankAccount\Schedule;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    public function schedule()
    {
        return $this->belongsTo('App\Models\BankAccount\Schedule');
    }

    public function mergeOrCreate($payload)
    {
        if(isset($payload['id'])) {
            $items = Items::findOrFail($payload['id']);
        } else {
            $items = new Items;
        }

        return $items;
    }
}