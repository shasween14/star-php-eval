<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        return view('articles.index');
    }

    public function show(Article $article)
    {
        abort_if($article->status === Article::DRAFT, 404);
        
        $article->load('category');
        return view('articles.show', compact('article'));
    }
}
