<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exceptions;
use App\Extension;

class ExtensionController extends Controller
{
    /**
     * ユーザーの拡張機能の有無の確認と追加済の一覧取得する
     * @return json 
     */
    public function index(){
        // Auth::user()->
        return response()->json([
            
        ]);
    }

    /**
     * 拡張機能追加画面のデータ
     * @return json
     */
    public function exAddList(Request $request){
        //拡張機能の一覧とユーザーの現在選択しているのカレンダーの状況を加工して返したい
        // [
        //     {
        //         'id' : '',
        //         'ex_name' : '',
        //         'explanation' : '',
        //         'flag' : '', <- これを追加
        //     },
        //     {
        //     }
        // ]
        $data = Extension::all();
        $user = $request->user();

        return $data;
    }
}
