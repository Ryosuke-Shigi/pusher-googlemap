<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\checked;
use App\Events\commented;
use App\Models\Check;
use illuminate\Http\JsonResponse;
use illuminate\View\View;

class checkController extends Controller
{
    //マップ表示
    public function viewer(){
        //チェックデータを全て抽出
        //$table=Check::all();
        //return view('test01',['table'=>$table]);
        return view('test01');
    }

    //イベント作成
    public function checker(REQUEST $request){
        event(new checked($request->latitude,$request->longitude,$request->zoom));
        return response()->json(['message'=>'チェック']);
    }

    //コメント投稿
    public function commenter(REQUEST $request){
        event(new commented($request->comment));
        return response()->jeson(['message'=>'comment']);
    }

}
