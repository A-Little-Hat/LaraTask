<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function create()
    {
        $cat = Category::all();
        $tasks = Task::all();
        $user=Auth::user();
        $v='user';
        $username = User::select('name')->where('role',$v)->get();
        // $username = User::all();
        return view('tasks.create', ['tasks' => $tasks, 'username'=> $username, 'category'=> $cat]);
    }

    public function store(Request $request)
    {
        $user = Auth::user(); 
        $task = new Task();
        $task->id = $user->id;
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->due_date = $request->input('dueDate');
        $task->status = $request->input('status');
        $task->category = json_encode($request->input('category',[]));
        $task->assigned = json_encode($request->input('assigned',[]));
        $task->save();
        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    public function main($task_id)
    {
        $comments=Comment::where('task_id',$task_id)->get();
        $task=Task::where('task_id',$task_id)->get();
        return view('tasks.main', ['task' => $task[0], 'comments'=>$comments]);
    }

    public function edit($task_id)
    {
        $cat = Category::all();
        $task = Task::where('task_id',$task_id)->get();
        $user=Auth::user();
        $v='user';
        $username = User::select('name')->where('role',$v)->get();
        return view('tasks.edit', ['task' => $task, 'username'=> $username, 'category'=> $cat]);
    }

    public function update(Request $request, $task_id)
    {

        Task::where('task_id', $task_id)
                ->update([
                    'title'=> $request->input('title'),
                    'description'=> $request->input('description'),
                    'due_date'=> $request->input('dueDate'),
                    'status'=> $request->input('status'),
                    'category'=> json_encode($request->input('category',[])),
                    'assigned'=> json_encode($request->input('assigned',[])),
                ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    public function editStatus($task_id)
    {
        return view('tasks.editStatus', ['task' => Task::where('task_id',$task_id)->get()]);
    }

    public function updateStatus(Request $request, $task_id)
    {

        Task::where('task_id', $task_id)
                ->update([
                    'status'=> $request->input('status')
                ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    public function remove($task_id)
    {
        Task::where("task_id",$task_id)->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }

    public function demo()
    {
        // []
        // $cat = Category::all();
        // $tasks = Task::all();
        $user=Auth::user();
        $v='user';
        $username = User::select('name')->where('role',$v)->whereNotIn('id',[$user->id])->get();
        print_r($username);
        // echo $username == [];
        // $username = User::all();
        // return view('tasks.create', ['tasks' => $tasks, 'username'=> $username, 'category'=> $cat]);
    }
}
