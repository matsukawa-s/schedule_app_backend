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

    /**
     * ユーザーのカレンダーを削除する
     */
    public function delete($id){
        $calendar = Calendar::find($id);
        $calendar->delete();

        return $calendar;
    }

    /**
     * カレンダー名を変更する
     */
    public function editCalendarName($id,Request $request){
        $input = $request->all();
        $calendar = Calendar::find($id);
        $calendar->cal_name = $input['editCalendarName'];
        $calendar->save();

        return $calendar;
    }
}
