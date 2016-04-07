<?php

namespace App\Http\Controllers;

use Request;

use App\Http\Controllers\Controller;

use App\Jobs\NotificationsQueue;

use App\Models\ApiMeli;
use App\Models\Notification;


class NotificationsController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return Response
  */
  public function index()
  {
    $request = Request::instance();
    $data = $request->getContent();
    $this->dispatch(new NotificationsQueue(json_decode($data)));

    // Notification::process(json_decode($data));
  }

}
