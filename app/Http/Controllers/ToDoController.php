<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Task;

class ToDoController extends Controller
{
    /**
     * 指定したカレンダーIDと一致するタスクの一覧を取得
     * 
     * @param id カレンダーID
     * @return json
     */
    public function index($id){
        $tasks = Task::where('calendar_id', $id)->get();

        return $tasks;
    }

    /**
     * タスクの保存
     * 
     * @param request
     * @return json
     */
    public function store(Request $request){
        $input = $request->all();

        $task = new Task;
        $task->task_name = $request -> task_name;
        $task->status = $request -> status;
        $task->date = $request -> date;
        $task->user_id = $request -> user_id;
        $task->calendar_id = $request -> calendar_id;

        $task->save();

        $id = $task->id;
        return $id;
    }

    /**
     * タスクを更新する
     * 
     * @param request
     * @param id タスクID
     * @return json
     */
    public function update(Request $request, $id){
        $input = $request->all();
        $task = Task::find($id);
        $task->task_name = $input['task_name'];
        $task->status = $input['status'];
        $task->date = $input['date'];
        $task->save();

        return $task;
    }

    /**
     * タスクを削除する
     * 
     * @param id タスクID
     * @return json
     */
    public function delete($id){
        $task = Task::find($id);
        $task->delete();

        return $task;
    }
}