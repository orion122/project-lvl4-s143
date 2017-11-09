<?php

namespace App\Http\Controllers;

use App\User;
use App\Task;
use App\Tag;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::orderBy('created_at', 'desc')->paginate(5);
        return view('tasks.index')->with('tasks', $tasks);
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