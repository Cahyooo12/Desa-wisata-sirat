<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::latest()->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category' => 'required|string',
        ]);

        $data = $request->except(['image', 'image_file']);

        // Use URL if provided
        if ($request->filled('image')) {
            $data['image'] = $request->image;
        }

        // Override with uploaded file if present
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('articles', 'public');
            $data['image'] = Storage::disk('public')->url($path);
        }

        Article::create($data);

        return redirect()->route('admin.articles.index')
                        ->with('success', 'Article created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view('admin.articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category' => 'required|string',
        ]);

        $data = $request->except(['image', 'image_file']);

        // Use URL if provided
        if ($request->filled('image')) {
            $data['image'] = $request->image;
        }

        // Override with uploaded file if present
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('articles', 'public');
            $data['image'] = Storage::disk('public')->url($path);
        }

        $article->update($data);

        return redirect()->route('admin.articles.index')
                        ->with('success', 'Article updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('admin.articles.index')
                        ->with('success', 'Article deleted successfully');
    }
}
