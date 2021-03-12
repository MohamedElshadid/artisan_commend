<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'tests';
    

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id', 'test_account_id');
    }
}
