<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use Mail;
use App\Mail\LaraTaskMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', ['tasks' => $tasks]);
    }
    public function show()
    {
        $task = Task::all();
        return response()->json($task);
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
        $userEmail = User::select('email')->whereIn('name', $request->input('assigned',[]))->get();
        // $i=0;
        foreach($userEmail as $u){
            $cname = User::select('name')->whereIn('email', $u)->get();
            $mailData=[
                'title'=>"Task Assigned",
                'body'=>'Dear '.$cname[0]->name.',
    
                LaraTask hopes this email finds you well. LaraTask wanted to inform you that '.$user->name.' has created a new task that you are assigned. Due date is '.$request->input('dueDate').'.
                Kindly check the details at your earliest convenience and proceed with the necessary actions. Your prompt attention to this matter would be greatly appreciated.
                
                If you have any questions or need further clarification regarding the task, please feel free to comment down in the task.
                
                Thank you for your cooperation.
                
                Best regards,
                Team LaraTask'
            ];
            Mail::to($u)->send(new LaraTaskMail($mailData));
        }
        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    public function main($task_id)
    {
        $comments=Comment::where('task_id',$task_id)->get();
        $task=Task::where('task_id',$task_id)->get();
        $documents = Storage::files("documents/{$task_id}");
        return view('tasks.main', ['task' => $task, 'comments'=>$comments, 'documents'=> $documents]);
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
                $userEmail = User::select('email')->whereIn('name', $request->input('assigned',[]))->get();
                // $i=0;
                foreach($userEmail as $u){
                    $cname = User::select('name')->whereIn('email', $u)->get();
                    $mailData=[
                        'title'=>"Task update alert",
                        'body'=>'Dear '.$cname[0]->name.',
            
                        LaraTask hopes this email finds you well. LaraTask wanted to inform you that '.$user->name.' has updated a task that you are assigned. Due date is '.$request->input('dueDate').'.
                        Kindly check the details at your earliest convenience and proceed with the necessary actions. Your prompt attention to this matter would be greatly appreciated.
                        
                        If you have any questions or need further clarification regarding the task, please feel free to comment down in the task.
                        
                        Thank you for your cooperation.
                        
                        Best regards,
                        Team LaraTask'
                    ];
                    Mail::to($u)->send(new LaraTaskMail($mailData));
                }
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
        // $documents = Storage::files("documents");
        $u = ['test','soumya'];
        dd(User::select('name','email')->whereIn('name',$u)->get());
    }
}
