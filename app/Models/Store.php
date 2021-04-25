<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = 'stores';

    protected $guarded = array('id');
  
    public $timestamps = true;

    // 企業情報
    //public function company() {
    //	return $this->belongsTo('App\Models\Company');
    //}

    public function getLiffIdFromStoreId($decoded_store_id)
    {
      $store = $this->where('store_id','=', $decoded_store_id)->first();

      if($store){
          $liff_id = $store->liff_id;
          return $liff_id;
      }else{
          return;
      }
    }

    public function getLiffIdFromId($decoded_store_id)
    {
      $store = $this->where('id','=', $decoded_store_id)->first();

      if($store){
          $name = $store->name;
          return $name;
      }else{
          return;
      }
    }

}
