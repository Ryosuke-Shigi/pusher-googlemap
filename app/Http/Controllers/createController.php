<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\room;

use Exception;

class createController extends Controller
{
    //ルーム作成
    //roomName passが送られてきます
    public function room(REQUEST $request){
        DB::beginTransaction();
        try{
            $table = new room;
            $table->roomName = $request->roomName;
            $table->pass = $request->pass;
            $table->save();
            DB::commit();
        }catch(Exception $exception){
            DB::rollBack();
            //throw $exception;
            return redirect()->route('route.roomCreate',['error'=>"error"]);
        }
        return redirect()->route('route.viewRooms');
    }

    //ルーム削除
    public function breakRoom(REQUEST $request){
        $table=DB::table('rooms')
                ->where('roomName','=',$request->roomName)
                ->first();
        //入力されたパスワードが異なれば前の画面へ戻る
        if($table->pass != $request->pass){
            return redirect()->route('route.delRoom',['roomName'=>$request->roomName,'error'=>"パスワードエラー"]);
        }else{
            //パスワードが正しければ削除処理して削除ルーム選択画面へ
            room::where('roomName','=',$request->roomName)->first()->delete();
        }
        return redirect()->route('route.viewDelRooms');
    }
}
