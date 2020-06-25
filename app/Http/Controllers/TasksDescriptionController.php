<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaskDescription;
use Illuminate\Support\Facades\Auth;

class TasksDescriptionController extends Controller
{
    public function get(Request $request) {

        $taskId = $request->route('tasksId');

        $tasks_desc = TaskDescription::where('tasks_id', $taskId)->get();

        return response()->json($tasks_desc, 200);
    }

    public function create(Request $request) {
        $taskId = $request->route('tasksId');
        $user = $request->user('api');
        $tasks_desc = new TaskDescription;
      
        $tasks_desc->tasks_id = $taskId;
        $tasks_desc->description = $request->description;
        $tasks_desc->user_id = $user->id;
        $tasks_desc->save();

        return response()->json($tasks_desc, 201);

    }

    public function delete(Request $request) {
        $taskId = $request->route('id');

        TaskDescription::where('id', $taskId)->delete();

        return response()->json($taskId, 205);
    }
}
