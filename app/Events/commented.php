<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

//ShouldBroadcast ブロードキャスト継承
class commented  implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    //メッセージ保管
    public $comment;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    //コンストラクタ
    public function __construct($comment)
    {
        //ここにテーブル保存とかいれればログを残せる
        $this->comment=$comment;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        //return new PrivateChannel('channel-name');
        return new Channel('comment');
    }
}
