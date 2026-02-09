<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::query();

        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }

        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%');
            });
        }

        $articles = $query->orderBy('published_at', 'desc')->get();
        
        $events = \App\Models\Event::orderBy('date', 'asc')->get();

        $categories = [
            ['name' => 'Events & Festival', 'count' => \App\Models\Event::count()],
            ['name' => 'Produk & UMKM', 'count' => Article::where('category', 'Produk & UMKM')->count()],
            ['name' => 'Kisah Komunitas', 'count' => Article::where('category', 'Kisah Komunitas')->count()],
            ['name' => 'Tips Kesehatan', 'count' => 0],
        ];

        return view('story.index', compact('articles', 'events', 'categories'));
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        $article->increment('views');

        $recentArticles = Article::where('id', '!=', $id)->orderBy('published_at', 'desc')->take(3)->get();

        $categories = [
            ['name' => 'Events & Festival', 'count' => \App\Models\Event::count()],
            ['name' => 'Produk & UMKM', 'count' => Article::where('category', 'Produk & UMKM')->count()],
            ['name' => 'Kisah Komunitas', 'count' => Article::where('category', 'Kisah Komunitas')->count()],
            ['name' => 'Tips Kesehatan', 'count' => 0],
        ];

        return view('story.show', compact('article', 'recentArticles', 'categories'));
    }
}
