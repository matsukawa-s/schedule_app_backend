<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Extension;
use App\CalendarExtension;

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
        // $extensions = Extension::all();
        $data = Extension::all()->toArray();
        $calendar_id = 1;

        $user = $request->user()->id;

        foreach($data as $key => $value){
            //対象のカレンダーに拡張機能を入れているかの情報を追加
            $flag = CalendarExtension::where('calendar_id',$calendar_id)
                ->where('extension_id',$value['id'])
                ->first();

            $data[$key]['flag'] = $flag == null ? false : true;
        }
        return $data;
    }

    /**
     * ユーザーの所持カレンダーに拡張機能を追加する
     */
    public function calendarExtensionAdd(Request $request){
        $input = $request->all();

        CalendarExtension::create([
            'calendar_id' => $input['calendar_id'],
            'extension_id' => $input['extension_id'],
        ]);
    }
}
