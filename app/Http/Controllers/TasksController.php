<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\TaskDescription;
use Auth;

class TasksController extends Controller
{
    
    public function get(Request $request)  {
        $user = $request->user('api');
        $offset = isset($request->offset) ? $request->offset : 0;
        $limit = isset($request->limit) ? $request->limit : 10;
        $search = $request->search;

        $tasks = Task::when($search, function($query) use ($search) {
            $query->where('title', 'like', '%'. $search .'%');
        })
            ->where('user_id', $user->id)
            ->orderBy('updated_at', 'desc')
            ->offset($offset)
            ->limit($limit)
            ->get();

        return response()->json($tasks, 200);
    }

    public function create(Request $request) {
        $user = $request->user('api');
        $tasks = new Task;
        $tasks->user_id =  $user->id;
        $tasks->title = $request->title;
        $tasks->save();

        return response()->json($tasks, 201);
    }

    public function update(Request $request)  {
        $taskId = $request->route('id');

        $tasks = Task::find($taskId);
        $tasks->title = $request->title;
        $tasks->completed = (int)$request->completed;
        $tasks->save();

        return response()->json($tasks, 201);
    }

    public function delete(Request $request) {
        $tasksId = $request->route('id');
        TaskDescription::where('tasks_id', $tasksId)->delete();
        Task::where('id', $tasksId)->delete();
        
        return response()->json($tasksId, 205);
    }

     public function markAll(Request $request) {
        $user = $request->user('api');
        $tasks = Task::where('user_id', $user->id)->update(["completed" => $request->completed]);
      
        return response()->json($tasks, 205);
    }
}
