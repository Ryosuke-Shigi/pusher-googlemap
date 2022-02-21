<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

//ここでチャンネルに対しての制限をかける
Broadcast::channel('check',function(){
    return true;//trueで全て
});

Broadcast::channel('comment',function(){
    return true;
});
