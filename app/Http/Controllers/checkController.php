<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\checked;
use App\Events\commented;
use App\Models\Check;
use illuminate\Http\JsonResponse;
use illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Models\comment;

class checkController extends Controller
{
    //マップ表示
    //name pass roomNameが送られてくる
    public function viewer(REQUEST $request){
        //チェックデータを全て抽出
        //$table=Check::all();
        //return view('test01',['table'=>$table]);
        $pass=DB::table('rooms')
                ->where('roomName','=',$request->roomName)
                ->first();

        //パスワードが正しいか判断
        if($pass->pass!=$request->pass || !isset($request->name)){
            return redirect()->route('route.login',["roomName"=>$request->roomName,"error"=>"エラー"]);
        }else{
            event(new commented($request->roomName,$request->name,"が入りました"));
            $table=DB::table('comments')
            ->where('roomName','=',$request->roomName)
            ->get();
        }

        return view('test01',['table'=>$table,'roomName'=>$request->roomName,'name'=>$request->name]);
    }

    //MAPイベント
    public function checker(REQUEST $request){
        event(new checked($request->roomName,$request->latitude,$request->longitude,$request->zoom));
        return response()->json(['message'=>'チェック']);
    }

    //コメント投稿
    public function commenter(REQUEST $request){
        event(new commented($request->roomName,$request->name,$request->comment));
        return response()->json(['message'=>'コメント']);
    }

}
