<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    //protected $primaryKey = 'line_accounts_id';

    protected $guarded = array('id');
  
    public $timestamps = true;

    // ラインアカウント情報
    //public function line_account() {
    //	return $this->belongsTo('App\Models\LineAccount');
    //}

}
