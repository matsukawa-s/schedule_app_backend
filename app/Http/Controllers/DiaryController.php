<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Diary;

class DiaryController extends Controller
{
    /**
     * カレンダーの日記の一覧を取得する
     * 
     * @param id カレンダーID
     * @return json
     */
    public function getDiaryData($id){
        $data = Diary::where('calendar_id',$id)->get();

        return $data;
    }
    
    /**
     * カレンダーに日記を保存する
     * 
     * @param request
     * @return json 
     */
    public function store(Request $request){
        $input = $request->all();
        
        $diary = Diary::create($input);

        return $diary;
    }
    /**
     * カレンダーの日記を更新する
     * 
     * @param request 
     * @param id 日記ID
     * @return json
     */
    public function update(Request $request,$id){
        $input = $request->all();
        $diary = Diary::find($id);
        $diary->date = $input['date'];
        $diary->article = $input['article'];
        $diary->save();

        return $diary;
    }

    /**
     * カレンダーの日記を削除する
     * 
     * @param Integer $id
     * @return json
     */
    public function delete($id){
        $diary = Diary::find($id);
        $diary->delete();

        return $diary;
    }


}