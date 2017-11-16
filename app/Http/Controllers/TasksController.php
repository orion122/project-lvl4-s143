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
            $task_ids = [];

            foreach (Task::all() as $task) {
                if (in_array($request->tag_id, $task->tags->pluck('id')->toArray())) {
                    $task_ids[] = $task->id;
                }
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
        $usersIDsNamesEmails = $this->getCollectionDataForSelect(User::all(), 'email');
        $statusesIDsNames = $this->getCollectionDataForSelect(TaskStatus::all());

        return view('tasks.create')->with([
            'users' => $users,
            'namesAndEmails' => $usersIDsNamesEmails,
            'statuses' => $statusesIDsNames
        ]);
    }


    public function store(Request $request)
    {
        $this->validation($request);

        $task = new Task;
        $task->fill($request->all());
        $task->save();

        $inputTags = explode(',', $request->tags);

        foreach ($inputTags as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $task->tags()->attach($tag->id);
        }

        return Redirect::route('tasks.index')->with('message', 'Successful!');
    }


    public function show($id)
    {
        return view('tasks.show')->with('task', Task::find($id));
    }


    public function edit(Task $task)
    {
        $usersIDsNamesEmails = $this->getCollectionDataForSelect(User::all(), 'email');
        $statusesIDsNames = $this->getCollectionDataForSelect(TaskStatus::all());


        return view('tasks.edit')->with([
            'task' => $task,
            'namesAndEmails' => $usersIDsNamesEmails,
            'statuses' => $statusesIDsNames
        ]);
    }


    public function update(Request $request, Task $task)
    {
        $this->validation($request);
        $task->fill($request->all());
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


    private function getCollectionDataForSelect($collection, $arg = null)
    {
        $ids = $collection->pluck('id')->toArray();
        $array1 = $collection->pluck('name')->toArray();
        $array2 = is_null($arg) ? null : $collection->pluck($arg)->toArray();

        return array_reduce(
            array_keys($ids),
            function ($acc, $num) use ($ids, $array1, $array2) {
                $acc[$ids[$num]] = is_null($array2) ? $array1[$num] : "$array1[$num] ($array2[$num])";
                return $acc;
            },
            []
        );
    }
}
