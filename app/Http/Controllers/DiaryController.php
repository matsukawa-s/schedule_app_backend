<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Diary;

class DiaryController extends Controller
{
    public function getDiaryList($id){
        $data = Diary::where('calendar_id',$id)->get();

        return $data;
    }

    public function addDiary(Request $request){
        $input = $request->all();

        return $input;
    }

    public function store(Request $request){
        $input = $request->all();

        // $data = Diary::create([
        //     'date' => $input->date,
        //     'article' => $input->article,
        //     'calendar_id' => $input->calendar_id
        // ]);
        
        $data = Diary::create($input);

        // return response()->json($data, 200, $headers);
        return $data;
    }


}
