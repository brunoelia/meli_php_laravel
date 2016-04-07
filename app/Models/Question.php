<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
  use SoftDeletes;

  protected $guarded = ['id'];
  protected $dates = ['deleted_at'];

  public function product()
  {
    return $this->belongsTo('App\Models\Product','product_id','id');
  }

  public static function answer($data)
  {
    $answer = Question::find($data['question_id']);
      $answer->answer = $data['answer'];
    if($answer->save())
    {
      return true;
    }
    return false;
  }
}
