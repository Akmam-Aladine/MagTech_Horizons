<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Subscription;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class ThemeManagerController extends Controller
{
    public function dashboard(): View|Factory|Application
    {
        $theme = Auth::user()->themes; // Thème géré par le Theme Manager

        $articles = $theme[0]->articles()->with('proposer')->get();
        //dd($articles->count());
        $subscribers = $theme[0]->subscriptions()->get();
        $subscribersData = User::whereIn('id', $subscribers->pluck('user_id'))->get();

        /*$comments = Comment::whereHas('article', function ($query) use ($theme) {
            $query->where('theme_id', $theme->id);
        })->with('article', 'user')->get();*/

        $comments = Comment::whereIn('article_id', $articles->pluck('id'))->with('article', 'user')->get();
        //dd($commentData);
//        $commentUsers = User::whereIn('id', $commentData->pluck('user_id'))->get();
//        dd($commentUsers);
//        $comments = [];
//
//
//        foreach ($commentData as $comment) {
//            if ($comment->article->theme->manager_id === Auth::id()) {
//                $comments[] = $comment;
//            }
//        }

        return view('/theme-manager/theme_manager_dashboard', [
            'articles' => $articles,
            'subscribers' => $subscribersData,
            'articlesCount' => $articles->count(),
            'subscribersCount' => $theme[0]->subscriptions()->count(),
            'comments' => $comments,
        ]);
    }

    public function approveArticle($id): Application|Redirector|RedirectResponse
    {
        $article = Article::findOrFail($id);
        $article->update(['status' => 'Approved']);

        return redirect('/theme-manager/dashboard')->with('success', 'Article approved successfully.');
    }

    public function rejectArticle($id): Application|Redirector|RedirectResponse
    {
        $article = Article::findOrFail($id);
        $article->update(['status' => 'Rejected']);

        return redirect('/theme-manager/dashboard')->with('success', 'Article rejected successfully.');
    }

    public function show($id): View|Factory|Application
    {
        $article = Article::findOrFail($id);

        return view('/theme-manager/show_article', compact('article'));
    }

    public function delete($id): RedirectResponse
    {
        $comment = Comment::with('article.theme')->findOrFail($id);
        //dd($comment);

        // Vérifie si l'utilisateur connecté est responsable du thème associé
        if ($comment->article->theme->manager_id !== Auth::id()) {
            abort(403, 'You are not authorized to delete this comment.');
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }


}
