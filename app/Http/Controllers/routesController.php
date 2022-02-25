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
    //ログイン画面表示
    public function login(REQUEST $request){
        return view('login',['roomName'=>$request->roomName]);
    }
    //ルーム作成画面表示
    public function roomCreate(REQUEST $request){
        return view('roomCreate');
    }

}
