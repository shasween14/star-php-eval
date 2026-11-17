<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ArticleController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $search = $request->query('search');
        $articles = Article::with('category')
            ->published()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($searchQuery) use ($search) {
                    $searchQuery->whereLike('title', "%{$search}%")
                        ->orWhereLike('author', "%{$search}%")
                        ->orWhereHas('category', fn ($categoryQuery) => $categoryQuery->whereLike('name', "%{$search}%"));
                });
            })->latest('published_at')->get();

        return ArticleResource::collection($articles);
    }
}
