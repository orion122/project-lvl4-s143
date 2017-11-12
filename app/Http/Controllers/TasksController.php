<?php

namespace App\Http\Controllers;

use App\TaskStatus;
use App\User;
use App\Task;
use App\Tag;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TasksController extends Controller
{

    public function index(Request $request)
    {
        $tasks = (new Task)->newQuery();

        if ($request->creator) {
            $tasks->where('creator', $request->creator);
        }
        if ($request->assignedTo) {
            $tasks->where('assignedTo', $request->assignedTo);
        }
        if ($request->status) {
            $tasks->where('status', $request->status);
        }
        if ($request->tag_id) {
            $tag = (new Tag())->setTable('task_tags')->newQuery();
            $tag->where('tag_id', $request->tag_id);

            $task_ids = [];

            foreach ($tag->get() as $item) {
                array_push($task_ids, $item->task_id);
            }

            $tasks->find($task_ids);
        }

        $tasks = $tasks->orderBy('created_at', 'desc')->paginate(5);

        $statuses = TaskStatus::all();
        $users = User::all();
        $tags = Tag::all();

        return view('tasks.index')->with([
            'tasks' => $tasks,
            'statuses' => $statuses,
            'users' => $users,
            'tags' => $tags
        ]);
    }


    public function create()
    {
        $users = User::all();

        return view('tasks.create')->with('users', $users);
    }


    public function store(Request $request)
    {
        $this->validation($request);

        $task = new Task;

        $task->name = $request->name;
        $task->description = $request->description;
        $task->creator = $request->creator;
        $task->assignedTo = $request->assignedTo;
        $task->save();

        $inputTags = explode(',', $request->tags);

        foreach ($inputTags as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $task->tags()->attach($tag->id);
        }

        return Redirect::back()->with('message', 'Successful!');
    }


    public function show($id)
    {
        return view('tasks.show')->with('task', Task::find($id));
    }


    public function edit(Task $task)
    {
        $users = User::all();
        $usersIDs = $users->pluck('id')->toArray();
        $usersNames = $users->pluck('name')->toArray();
        $usersEmails = $users->pluck('email')->toArray();

        $usersIDsNamesEmails = array_reduce(
            array_keys($usersIDs),
            function ($acc, $num) use ($usersIDs, $usersNames, $usersEmails) {
                $acc[$usersIDs[$num]] = "$usersNames[$num] ($usersEmails[$num])";
                return $acc;
            },
            []
        );


        $statuses = TaskStatus::all();
        $statusesIDs = $statuses->pluck('id')->toArray();
        $statusesNames = $statuses->pluck('name')->toArray();

        $statusesIDsNames = array_reduce(
            array_keys($statusesIDs),
            function ($acc, $num) use ($statusesIDs, $statusesNames) {
                $acc[$statusesIDs[$num]] = $statusesNames[$num];
                return $acc;
            },
            []
        );


        return view('tasks.edit')->with([
            'task' => $task,
            'namesAndEmails' => $usersIDsNamesEmails,
            'statuses' => $statusesIDsNames
        ]);
    }


    public function update(Request $request, Task $task)
    {
        $this->validation($request);

        $task->name = $request->name;
        $task->description = $request->description;
        $task->creator = $request->creator;
        $task->assignedTo = $request->assignedTo;
        $task->status = $request->status;
        $task->save();

        $inputTags = explode(',', $request->tags);

        $task->tags()->detach();

        foreach ($inputTags as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $task->tags()->attach($tag->id);
        }

        return Redirect::back()->with('message', 'Successful!');
    }


    public function destroy(Task $task)
    {
        $task->delete();
        return Redirect::route('tasks.index');
    }


    private function validation(Request $request)
    {
        return $request->validate([
            'name'          => 'required|string|max:255',
            'description'   => 'string|max:1024',
            'status'        => 'required|exists:task_statuses,id',
            'creator'       => 'required|exists:users,id',
            'assignedTo'    => 'required|exists:users,id',
            'tags'          => 'required|string|max:255',
        ]);
    }
}
