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
            throw $exception;
        }
        return redirect()->route('route.viewRooms');
    }
}
