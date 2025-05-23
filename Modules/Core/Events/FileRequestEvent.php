<?php
namespace Modules\Core\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class FileRequestEvent implements ShouldBroadcast
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $file_url;
  public $user_id;

  public function __construct($file_url,$user_id)
  {
      $this->file_url = $file_url;
      $this->user_id = $user_id;
  }

  public function broadcastOn()
  {
      return ['file-channel'];
  }

  public function broadcastAs()
  {
      return 'file-event';
  }
}