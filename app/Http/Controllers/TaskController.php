<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use illuminate\support\facades\Auth;
use App\Models\User;

class TaskController extends Controller
{
    public function index()

    {
        $user_id=Auth::user()->id;
        $task=Task::where('user_id',  $user_id)->get();
        return $task;
    }

    public function store(Request $request)
    {
        $task = new Task;
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->user_id=Auth::user()->id;
        $task->completed = $request->input('completed', false);
        $task->save();

        return $task;
    }

    public function show($id)
    {
        $task=Task::findOrFail($id);
        return $task;
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->completed = $request->input('completed', false);
        $task->save();

        return $task;
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(['message' => 'Task deleted successfully']);
    }
}
