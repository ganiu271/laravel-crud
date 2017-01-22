<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\Form;
use App\Validate;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $tasks = Task::orderBy('name','ASC')->paginate(3);
       // $tasks = DB::table('task')->paginate(15);

        //$tasks = DB::table('tasks')->simplePaginate(15);


        return view('task.list',compact('tasks'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validated input request
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);

        // create new task
        Task::create($request->all());
        return redirect()->route('tasks.index')->with('success', 'Your task added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);
        return view('task.show',compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        return view('task.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if($request->isJson()){
            $this->validate($request, [
                'name' => 'required',
                //'description' => 'required'
            ]);

            $update_task = Task::find($id)->update($request->all());
            if($update_task)
                return response()->json(['success' => 'Task updated successfully']);
        }

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);

        $update_task = Task::find($id)->update($request->all());
        if($update_task)
            return redirect()->route('tasks.index')->with('success','Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Task::find($id)->delete();
        return redirect()->route('tasks.index')->with('success','Task removed successfully');
    }
}