<?php

namespace App\Console\Commands;

use App\Models\Todo;
use App\Models\TodoList;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ScrapeTodos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lbi:scrape';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape todos from the web';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/todos');
//        $this->info($response);
        $todos = $response->json();
//        $this->table(
//            [],
//            $todos
//        );

        $tl = new TodoList();
        $tl->name="imported todoList";
        $tl->save();

        $d = collect($todos)->map(function($todo) use ($tl) {
            return ['todo_list_id' => $tl->id,
                'due_date' => Carbon::now()->add(6, 'month'),
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'content' => $todo['title'],
                'done' => boolval($todo['completed'])];
        })->toArray();

        Todo::insert($d);

        return 0;
    }
}
