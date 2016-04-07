<?php namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\Notification;

use Log;

class NotificationsQueue extends Job implements SelfHandling, ShouldQueue
{
  use InteractsWithQueue, SerializesModels;

  protected $msg;

  /**
  * Create a new job instance.
  *
  * @return void
  */
  public function __construct($notifications)
  {
    $this->msg = $notifications;
  }

  /**
  * Execute the job.
  *
  * @return void
  */
  public function handle()
  {
    Notification::process($this->msg);

    // return true;
  }

  public function failed()
  {
    print_r("Faio");
  }
}
