<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Todo;
use App\Models\TodoList;
use App\Repositories\TodoRepository;
use Illuminate\Http\Request;

class TodoApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todo = Todo::with('tags')->get();
        return response()->json($todo);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, TodoRepository $repo)
    {
//        $request->validate([
//            'content' => 'required'
//        ]);
//        dd('test toto');

        $tags = explode(',', $request->tags);
        collect($tags)->each(function (string $tag) {
            Tag::updateOrCreate(
                ['name' => $tag],
                ['name' => $tag]
            );
        });

        $tagsId = Tag::whereIn('name', $tags)->pluck('id')->toArray();

        $t = new Todo();
        $t->content = $request->input('content');
        $t->done = $request->has('done');
        $t->due_date = date(now()->add(6, 'month'));
        $t->todo_list_id = $request->todo_list_id;
        $tl = TodoList::where('id', $request->todo_list_id)->first();
        $tl->todos()->save($t);
        $t->tags()->attach($tagsId);
        $repo->save($t);

        return response()->json($t);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
       return response()->json($todo);
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
        return response()->json($todo);
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
        response()->json();
    }
}
