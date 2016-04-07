<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  public function Category()
  {
    return $this->belongsTo('App\Models\Category','category_id','id');
  }

  public function Images()
  {
    return $this->hasMany('App\Models\Images','id','product_id');
  }

  public function listed()
  {
    return $this->hasOne('App\Models\Listed','product_id','id');
  }

  public function questions()
  {
    return $this->hasMany('App\Models\Question','product_id','id');
  }
}
