<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HelloController extends Controller
{
    public function index(Request $request, string $name) {
        Log::debug('Hello');
        Log::debug($name);
        $value = $request->request->all();
        Log::debug($value);
        return view('hello.index', compact('name'));
    }
}
