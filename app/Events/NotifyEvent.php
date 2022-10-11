<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotifyEvent  implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $user;
    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $message)
    {
        $this->user = $user;
        // \Log::info('=================');
        // \Log::info($user);
        // \Log::info('=================');
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    // public function broadcastOn()
    // {
    //     $f = new PrivateChannel('canal.'.$this->user->id);
    //     \Log::info('===YUYU====');
    //     \Log::info($f);
    //     return $f;
    //     // return new PrivateChannel('private-event.'.$this->user->id);
    // }


      public function broadcastOn()
      {
          return ['canal-'.$this->user->id];
      }

      public function broadcastAs()
      {
          return 'private-event';
      }

    // public function broadcastWith()
    // {
    //     //return ['id' => $this->user->id];
    // }
}
