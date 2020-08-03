<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Calendar;
use App\Schedule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class SchedulesController extends Controller
{
    /**
     * 指定されたカレンダーの予定を全て取得する
     * @param calendar_id
     * @return json
     */
    public function index($id){
        $schedules = \App\Schedule::where("calendar_id", $id)->get();

        return response()->json($schedules);
    }

    /**
     * 指定した予定を取得する
     * @param schedule_id
     * @return json
     */
    public function show($id){
        $schedule = \App\Schedule::find($id);

        return response()->json($schedule);
    }

    public function store(Request $request){
        $input = $request->all();
        $data = Schedule::create($input);
        return $data;
    }
    /**
     * 指定した日付の予定を全て取得する
     * @param start_date
     * @return json
     */
    public function getSchedulesDate($date){
        $schedules = \App\Schedule::where("start_date",'like',$date.'%')->get();
        
        return response()->json($schedules);
    }


}