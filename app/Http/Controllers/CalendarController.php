<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calendar;

class CalendarController extends Controller
{
    /**
     * ユーザーのカレンダーを表示する
     */
    public function getUserCalendar(Request $request){
        $user = $request->user()->id;

        $data = Calendar::where('user_id',$user)->get();

        return $data;
    }

    /**
     * ユーザーのカレンダーを新規作成する
     */
    public function store(Request $request){
        $input = $request->all();
        $user = $request->user()->id;

        $data = Calendar::create([
            'cal_name' => $input['cal_name'],
            'user_id' => $user

        ]);
        return $data;
    }
}
