<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeliAccess extends Model
{
    protected $fillable = ['access_token', 'refresh_token', 'cust_id', 'expires_in'];

    public function user()
    {
    	return $this->belongsTo('App\Models\User', 'id', 'meli_access_id');
    }
}
