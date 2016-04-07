<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

  protected $guarded = ['id'];

  public function buyer()
  {
    return $this->belongsTo('App\Models\Buyer','buyer_id','id');
  }

  public function product()
  {
    return $this->hasOne('App\Models\Product','id','product_id');
  }

  public function payment()
  {
    return $this->hasOne('App\Models\Payment','id','payment_id');
  }

  public function status_id()
  {
    return $this->hasOne('App\Models\Status','status_id','id');
  }
}
