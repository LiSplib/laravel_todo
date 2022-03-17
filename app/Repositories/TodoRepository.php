<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\Todo;
use Illuminate\Database\Eloquent\Model;

class TodoRepository implements RepositoryInterface{

    public function findAll()
    {
        // TODO: Implement findAll() method.
        return Todo::all();
    }

    public function findById(int $id)
    {
        // TODO: Implement findById() method.
        return Todo::where('id', $id)->get()->first();
    }

    public function save(Model $model)
    {
        // TODO: Implement save() method.
        $model->save();
    }
}
