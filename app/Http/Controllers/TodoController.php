<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use GrahamCampbell\ResultType\Result;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Todo::latest()->get();
        return view('welcome')->with('todos', $todos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|max:255',
        ]);
        $todo = Todo::create([
            'title' => $request->title,
            'completed' => false,
        ]);
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {

        return view('todo.edit')->with('todo', $todo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {


        $todo->update($request->all());
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {

        $todo->delete();
        return redirect('/');
    }
    function list($id = null)
    {
        return $id ? Todo::find($id) : Todo::all();
    }
    function addTodo(Request $req)
    {
        $todo = new Todo;
        $todo->title = $req->title;
        $todo->completed = false;
        $result = $todo->save();

        if ($result) {
            return ["result" => "todo added successfully"];
        } else {
            return [
                "result" => "todo addition failed"
            ];
        }
    }
    function updateTodo(Request $req)
    {
        dd();
        $todo = Todo::find($req->id);
        $todo->title = $req->title;
        $result = $todo->save();
        if ($result) {
            return [
                "result" => "todo updated succesfully"
            ];
        } else {
            return [
                "result" => "todo updation failed"
            ];
        }
    }

    function deleteTodo(Request $req)
    {
        $todo = Todo::find($req->id);
        $result = $todo->delete();
        if ($result) {
            return [
                "result" => "deletion success"
            ];
        } else {
            return [
                "result" => "deletion failed"
            ];
        }
    }

    function completeTodo(Request $req)
    {
        dd($req);
        $todo = Todo::find($req->id);
        $todo->completed = $req->completed;
        $result = $todo->save();
        if ($result) {
            return [
                "result" => "todo updated"

            ];
        } else {
            return [
                "result " => "task failed"
            ];
        }
    }
}
