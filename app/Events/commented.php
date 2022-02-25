<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use App\Models\comment;
//ShouldBroadcast ブロードキャスト継承
class commented  implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    //メッセージ保管
    public $roomName;
    public $name;
    public $comment;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    //コンストラクタ
    public function __construct($roomName,$name,$comment)
    {
        //ここにテーブル保存とかいれればログを残せる
        $this->roomName=$roomName;
        $this->name=$name;
        $this->comment=$comment;

        DB::beginTransaction();
        try{
            $table = new comment;
            $table->roomName = $roomName;
            $table->name = $name;
            $table->comment = $comment;
            $table->save();
            DB::commit();
        }catch(Exception $exception){
            DB::rollBack();
            throw $exception;
        }
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
