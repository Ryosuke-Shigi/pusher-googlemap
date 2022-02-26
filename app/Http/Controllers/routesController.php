<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\room;

class routesController extends Controller
{
    //ルーム選択画面
    public function viewRooms(REQUEST $request){
        $table=DB::table('rooms')->get();
        return view('rooms',['table'=>$table]);
    }
    //削除ルーム選択画面
    public function viewDelRooms(REQUEST $request){
        $table=DB::table('rooms')->get();
        return view('delRooms',['table'=>$table]);
    }
    //ログイン画面表示
    public function login(REQUEST $request){
        return view('login',['roomName'=>$request->roomName]);
    }
    //ルーム削除承認画面表示
    public function delRoom(REQUEST $request){
        return view('delRoom',['roomName'=>$request->roomName]);
    }

    //ルーム作成画面表示
    public function roomCreate(REQUEST $request){
        return view('roomCreate');
    }

}
