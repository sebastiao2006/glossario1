<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Post extends Model
{
    

public function index()
{
    $posts = Post::all(); // pega todos os posts do banco
    return view('home', compact('posts'));
}
}
