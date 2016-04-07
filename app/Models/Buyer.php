<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{

  protected $guarded = ['id'];

  public function getNameAttribute()
  {
    return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
  }
}
