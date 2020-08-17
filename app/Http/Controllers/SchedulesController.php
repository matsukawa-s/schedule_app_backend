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

    /**
     * 予定を保存する
     * 
     * @param request
     * @return json 
     */
    public function store(Request $request){
        $input = $request->all();
        $data = Schedule::create($input);
        return $data;
    }

    /**
     * 予定を更新する
     * 
     * @param request 
     * @param id スケジュールID
     * @return json
     */
    public function update(Request $request,$id){
        $input = $request->all();
        $schedule = Schedule::find($id);
        $schedule->title = $input['title'];
        $schedule->all_day = $input['all_day'];
        $schedule->start_date = $input['start_date'];
        $schedule->end_date = $input['end_date'];
        $schedule->repetition_flag = $input['repetition_flag'];
        $schedule->repetition = $input['repetition'];
        $schedule->notification_flag = $input['notification_flag'];
        $schedule->notification = $input['notification'];
        $schedule->color = $input['color'];
        $schedule->place = $input['place'];
        $schedule->url = $input['url'];
        $schedule->memo = $input['memo'];
        $schedule->save();

        return $schedule;
    }
    
    /**
     * 予定を削除する
     * 
     * @param Integer $id
     * @return json
     */
    public function delete($id){
        $schedule = Schedule::find($id);
        $schedule->delete();

        return $schedule;
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