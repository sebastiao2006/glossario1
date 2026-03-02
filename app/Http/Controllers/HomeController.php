<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; // se você tem um model Post

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::all(); // pega todos os posts do banco de dados
        return view('home', compact('posts'));
    }
}