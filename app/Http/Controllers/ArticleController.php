<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\BrowsingHistory;
use App\Models\Comment;
use App\Models\Theme;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function show($id): View|Factory|Application
    {
        $article = Article::findOrFail($id);
        //dd($article);
        $comments = $article->comments()->with('user')->get();
        $averageRating = $article->averageRating();
        $totalRatings = $article->ratings()->count(); // Nombre total de notes

        // Ajouter l'entrée dans l'historique
        if(Auth::check()){
            BrowsingHistory::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'article_id' => $id,
                ],
                ['viewed_at' => now()]
            );
        }

        return view('article', compact('article', 'comments', 'averageRating', 'totalRatings'));

    }

    public function addComment(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $article = Article::findOrFail($id);

        $article->comments()->create([
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
        ]);

        /*Comment::create([
            'user_id' => Auth::id(),
            'content' => 'first comment',
            'article_id' => 2,
        ]);*/

        return back()->with('success', 'Comment added successfully!');
    }

    public function rateArticle(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $article = Article::findOrFail($id);

        $article->ratings()->updateOrCreate(
            ['user_id' => Auth::id()],
            ['rating' => $request->input('rating')]
        );

        return back()->with('success', 'Thank you for rating!');
    }

    public function showProposeArticleForm(): View|Factory|Application
    {
        $themes = Theme::all(); // Charger tous les thèmes
        return view('propose_article', compact('themes'));
    }

    public function submitArticle(Request $request): Application|Redirector|RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'theme' => 'required|exists:themes,id',
            'content' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Gérer l'upload de l'image
        $imagePath = $request->file('image')->store('articles', 'public');

        //dd($imagePath);

        // Créer un nouvel article
        Article::create([
            'title' => $validated['title'],
            'theme_id' => $validated['theme'],
            'content' => $validated['content'],
            'image' => $imagePath,
            'user_id' => Auth::id(), // ID de l'utilisateur connecté
            'status' => 'Pending', // Par défaut en attente de validation
            'proposed_by' => Auth::id(), // ID de l'utilisateur connecté
        ]);

        return redirect('/')->with('success', 'Your article has been submitted for review!');
    }
    public function myArticles(): View|Factory|Application
    {
        $articles = Article::where('proposed_by', Auth::id())->latest()->get();

        return view('my_articles', compact('articles'));
    }

    public function deleteArticle($id): Application|Redirector|RedirectResponse
    {
        $article = Article::where('id', $id)
            ->where('proposed_by', Auth::id())
            ->whereNotIn('status', ['Approved', 'Published'])
            ->firstOrFail();

        $article->delete();

        return redirect('/my-articles')->with('success', 'Article deleted successfully.');
    }
}
