<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
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
        $data = Diary::where('calendar_id',$id)->orderby('date')->get();

        return $data;
    }
    
    /**
     * カレンダーに日記を保存する
     * 
     * @param request
     * @return json 
     */
    public function store(Request $request){
        // return \json_encode($request->all()["data"]);

        $post_data =  $request->all();

        //画像が送られて来ているかチェック
        if ($request->hasFile('image')) {
            $path = $this->upFile($request);
            if($path == false){
                return response()->json([
                    'status' => 400,
                    'error' => '画像ファイルではありません'
                ]);
            }
        }
        
        $diary = Diary::create([
            'date' => $post_data['date'], 
            'article' => $post_data['article'],
            'calendar_id' => $post_data['calendar_id'],
            'image_path' => isset($path) ? basename($path) : null
        ]);

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

        if ($request->hasFile('image')) {
            $path = $this->upFile($request);

            if($path == false){
                return response()->json([
                    'status' => 400,
                    'error' => '画像ファイルではありません'
                ]);
            }

            $diary->image_path = basename($path);
        }

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

    function upFile($request){
        // バリデーションルール
        $rules = [
            'image' => 'image'//jpeg, png, bmp, gif, svg
        ];

        // return $request->all();
        $validator = Validator::make($request->all(), $rules);

        // バリデーションチェックを行う
        if ($validator->fails()) {
            return false;
        }
        //画像の保存処理（storage/public/diary_images）
        $path = $request->file('image')->store('public/diary_images');

        return $path;
    }


}