<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Task;
use App\Taskgroup;

class ToDoController extends Controller
{

    /**
     * 指定したカレンダーIDと一致するタスクグループとそれに属するタスクの一覧を取得
     * 
     * @param id カレンダーID
     * @return json
     */
    public function getTask($id){
        $data = Task::select('tasks.id', 'tasks.task_name', 'tasks.status', 'tasks.date', 'tasks.taskgroup_id', 'tasks.user_id', 'taskgroups.taskgroup_name', 'taskgroups.color')
                    ->join('taskgroups', 'taskgroups.id', '=', 'tasks.id')
                    ->where('taskgroups.calendar_id', $id)
                    ->get();

        return $data;
    }

    /**
     * タスクグループの保存
     * 
     * @param request
     * @return json
     */
    public function storeTaskgroup(Request $request){
        $input = $request->all();

        $taskgroup = Taskgroup::create($input);
        return $taskgroup;
    }

    /**
     * タスクの保存
     * 
     * @param request
     * @return json
     */
    public function storeTask(Request $request){
        $input = $request->all();

        $task = Task::create($input);
        return $task;
    }

    /**
     * タスクグループを更新する
     * 
     * @param request
     * @param id タスクグループID
     * @return json
     */
    public function updateTaskgroup(Request $request, $id){
        $input = $request->all();
        $taskgroup = Taskgroup::find($id);
        $taskgroup->taskgroup_name = $input['taskgroup_name'];
        $taskgroup->color = $input['color'];
        $taskgroup->save();

        return $taskgroup;
    }

    /**
     * タスクを更新する
     * 
     * @param request
     * @param id タスクID
     * @return json
     */
    public function updateTask(Request $request, $id){
        $input = $request->all();
        $task = Task::find($id);
        $task->task_name = $input['task_name'];
        $task->status = $input['status'];
        $task->date = $input['date'];
        $task->save();

        return $task;
    }

    /**
     * タスクグループを削除する
     * 
     * @param id タスクグループID
     * @return json
     */
    public function deleteTaskgroup($id){
        //タスクグループ消したら外部キー的に削除されるはず
        $taskgroup = Taskgroup::find($id);
        $taskgroup->delete();

        return $taskgroup;
    }

    /**
     * タスクを削除する
     * 
     * @param id タスクID
     * @return json
     */
    public function deleteTask($id){
        $task = Task::find($id);
        $task->delete();

        return $task;
    }
}