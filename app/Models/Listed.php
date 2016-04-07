<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Log;

class Listed extends Model
{
  protected $table = 'listed';


  public static function getIdFromMeliId($id)
  {
    $product = Listed::where('meli_id',$id)->first();
    if(empty($product)) {

      Log::error('product not found');
    	$output = false;
    } else {
    	$output = $product->product_id;
    }

    return $output;
  }
}
