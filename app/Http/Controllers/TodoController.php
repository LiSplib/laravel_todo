<?php

namespace App\Http\Controllers;

use App\Interfaces\RepositoryInterface;
use App\Models\Tag;
use App\Models\Todo;
use App\Models\TodoList;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    private $repo;

    public function __construct(RepositoryInterface $repo){
        $this->repo = $repo;
    }
    public function index(){
//        $todos = Todo::all();
        $todos = $this->repo->findAll();

        return view('todo.index', compact('todos'));
    }

    public function delete(Todo $todo){
        $todo->delete();
        return redirect()->route('todo.index')->withSuccess('To delete ok');

    }

    public function show(int $id){
        $todo = Todo::findOrFail($id);
        return view('todo.show', compact('todo'));
    }

    public function create(Request $request){
        if(request()->isMethod('post')){
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
            $this->repo->save($t);

            $request->validate([
                'content' => 'required'
            ]);

//            Todo::create([
//                'content' => $request->input('content'),
//                'done' => $request->has('done'),
//                'due_date' => date(now())
//            ]);
            return redirect()->route('todo.index')->withSuccess('To create ok');
        } else {
            $todoList = TodoList::all();

        }
        return view('todo.create', compact('todoList'));
    }
}
