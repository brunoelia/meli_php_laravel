<?php

namespace App\Models;

use App\Models\ApiMeli;
use App\Models\Question;

use Log;

class Notification
{

  public static function process($data)
  {
    $apiMeli = new ApiMeli();

    if ($data->topic == 'questions')
    {
      return $apiMeli->gotQuestion($data);
    } elseif ($data->topic == 'items')
    {
      return $apiMeli->gotItem($data);
    } elseif ($data->topic == 'orders')
    {
      return $apiMeli->gotOrder($data);
    } else
    {
      return true;
    }
  }

}
