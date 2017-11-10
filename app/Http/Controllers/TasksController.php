<?php

namespace App\Http\Controllers;

use App\TaskStatus;
use App\User;
use App\Task;
use App\Tag;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use function PHPSTORM_META\type;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();

        return view('tasks.create')->with('users', $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$request->validate([
            'name' => 'required|string|max:255',
            'description' => '',
            'status' => '',
            'creator' => '',
            'assignedTo' => '',
            'tags' => 'required|string|max:255'
        ]);*/

        $task = new Task;

        $task->name = $request->name;
        $task->description = $request->description;
        $task->creator = $request->user_id;
        $task->assignedTo = $request->assignedTo;

        $task->save();

        $inputTags = explode(',', $request->tags);

        foreach ($inputTags as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $task->tags()->attach($tag->id);
        }



        return Redirect::back()->with('message', 'Successful!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('tasks.show')->with('task', Task::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
