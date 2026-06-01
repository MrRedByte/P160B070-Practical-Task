<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Author;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $articles = Article::with('author')
            ->orderBy('publication_date', 'desc')
            ->get();
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        $authors = Author::all();
        return view('articles.create', compact('authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'publication_date' => 'required|date',
            'author_id' => 'required|exists:authors,id',
        ]);

        Article::create($request->all());

        return redirect()->route('articles.index')
            ->with('success', __('Article created successfully.'));
    }

    public function edit(Article $article)
    {
        $authors = Author::all();
        return view('articles.edit', compact('article', 'authors'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'publication_date' => 'required|date',
            'author_id' => 'required|exists:authors,id',
        ]);

        $article->update($request->all());

        return redirect()->route('articles.index')
            ->with('success', __('Article updated successfully.'));
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('articles.index')
            ->with('success', __('Article deleted successfully.'));
    }

    public function filter(Request $request)
    {
        $authors = Author::all();
        $selectedAuthorId = $request->input('author_id');

        if ($selectedAuthorId) {
            $articles = Article::with('author')
                ->where('author_id', $selectedAuthorId)
                ->orderBy('publication_date', 'desc')
                ->get();
        } else {
            $articles = collect();
        }

        return view('articles.filter', compact('articles', 'authors', 'selectedAuthorId'));
    }
}
