<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'accounts';
    
    public function reports()
    {
        return $this->hasMany(Report::class, 'test_account_id', 'account_id');
    }
}
