<?php

namespace App\Http\Controllers;

use App\Filters\DescriptionFilter;
use App\Filters\StatusFilter;
use App\Filters\TaskSorter;
use App\Filters\TitleFilter;
use App\Http\Requests\Tasks\CreateTaskRequest;
use App\Http\Requests\Tasks\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class TasksController extends Controller
{
    /**
     * Create a new controller instance
     */
    public function __construct(
        private Pipeline $pipeline
    ) {
        $this->middleware('auth');
        $this->pipeline = $pipeline;
    }

    /**
     * Show a list of resources
     *
     * @return \Illuminate\View\View
     */
    public function index() : View
    {
        $this->authorize('viewAny', Task::class);

        $query = Task::query()->where('user_id', Auth::id());

        $tasks = $this->pipeline
            ->send($query)
            ->through([
                TitleFilter::class,
                DescriptionFilter::class,
                StatusFilter::class,
                TaskSorter::class
            ])
            ->then(function (Builder $query){
                return $query->paginate();
            });

        return view('tasks.index', [
            'tasks' => TaskResource::collection($tasks)
        ]);
    }

    /**
     * Show the form to create a new tasks
     *
     * @return \Illuminate\View\View
     */
    public function create() : View
    {
        $this->authorize('create', Task::class);
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage
     *
     * @param \App\Http\Requests\Tasks\CreateTaskRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateTaskRequest $request) : RedirectResponse
    {
        $this->authorize('create', Task::class);

        return DB::transaction(function () use ($request) {
            $task = $request->user()->tasks()->create($request->validated());
            Session::flash('notification', [
                'type' => 'success',
                'message' => 'Task added successfully!'
            ]);

            return redirect()->route('tasks.show', ['task' => $task]);
        });
    }

    /**
     * Show the selected resource
     *
     * @return \Illuminate\View\View
     */
    public function show(Task $task) : View
    {
        $this->authorize('view', $task);

        return view('tasks.show', [
            'task' => $task
        ]);
    }

    /**
     * Show the form to edit a task
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\View\View
     */
    public function edit(Task $task) : View
    {
        $this->authorize('update', $task);

        return view('tasks.edit', [
            'task' => $task
        ]);
    }

    /**
     * Update the specified resource
     *
     * @param \App\Http\Requests\Tasks\UpdateTaskRequest $request
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateTaskRequest $request, Task $task) : RedirectResponse
    {
        $this->authorize('update', $task);

        return DB::transaction(function () use ($request, $task) {
            $task->update($request->validated());
            Session::flash('notification', [
                'type' => 'success',
                'message' => 'Task updated successfully!'
            ]);

            return redirect()->route('tasks.show', ['task' => $task]);
        });
    }

    /**
     * Delete the specified resource from storage
     *
     * @param \App\Models\Task
     */
    public function destroy(Task $task) : RedirectResponse
    {
        $this->authorize('delete', $task);
        $task->delete();

        Session::flash('notification', [
            'type' => 'success',
            'message' => 'Task deleted successfully!'
        ]);

        return redirect()->route('tasks.index');
    }
}
