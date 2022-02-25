<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class routesController extends Controller
{
    //ルーム選択画面
    public function viewRooms(REQUEST $request){
        return view('Rooms');
    }
    public function login(REQUEST $request){
        return view('login');
    }
    public function roomCreate(REQUEST $request){
        return view('roomCreate');
    }
}
