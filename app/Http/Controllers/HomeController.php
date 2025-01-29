<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\BrowsingHistory;
use App\Models\Issue;
use App\Models\Subscription;
use App\Models\Theme;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home(): View|Factory|Application
    {
        $themes = Theme::all(); // Tous les thèmes pour les invités
        $publicIssues = Issue::where('is_public', true)->get(); // Numéros publics
        $issues = Issue::all(); // Tous les numéros


        /*$subscribedThemes = Auth::check() && Auth::user()->role === 'Subscriber'
            ? Auth::user()->themes // Thèmes auxquels l'abonné est inscrit
            : [];*/

        return view('home', compact('themes', 'publicIssues', 'issues'));
    }

    // Affiche les articles d'un thème spécifique
    public function showArticles($themeId): View|Factory|Application
    {
        // Récupérer le thème par son ID
        $theme = Theme::findOrFail($themeId);
        // Récupérer les articles associés au thème
        $articles = Article::where('theme_id', $themeId)
            ->where('status', 'Published')
            ->get();

        $is_subscribed = Subscription::where('user_id', Auth::id())
            ->where('theme_id', $themeId)
            ->exists();

        //dd($is_subscribed);

        //dd(Auth::user()->themes);

        // Retourner la vue avec le thème et les articles associés
        return view('themes.articles', compact('theme', 'articles', 'is_subscribed'));
    }

    // Affiche les articles d'un numéro spécifique
    public function showIssueArticles($issueId): View|Factory|Application
    {
        // Récupérer le numéro par son ID
        $issue = Issue::findOrFail($issueId);

        //dd($issue);

        // Récupérer les articles associés au numéro
        $articles = $issue->articles->where('status', 'Published');

        //$theme = Theme::where('id', $issue->theme_id)->first();

        //dd($articles);

        // Retourner la vue avec le numéro et les articles associés
        return view('issues.articles', compact('issue', 'articles'));
    }

    public function browsingHistory(): View|Factory|Application
    {
        // Récupérer l'historique de navigation de l'utilisateur connecté
        $history = BrowsingHistory::with('article.theme')
            ->where('user_id', Auth::id())
            ->orderBy('viewed_at', 'desc')
            ->get();


        // Retourner la vue avec les données
        return view('browsing_history', compact('history'));
    }

    public function subscriptions(): View|Factory|Application
    {
        // Récupérer les abonnements de l'utilisateur
        $subscriptions = Subscription::where('user_id', Auth::id())->get();

        // Récupérer les thèmes associés aux abonnements
        $themes = Theme::whereIn('id', $subscriptions->pluck('theme_id'))
            ->with(['articles' => function ($query) {
                $query->where('status', 'Published')->latest(); // Charger uniquement les articles publiés et les trier
            }])
            ->get();

        // Retourner la vue avec les thèmes et leurs articles
        return view('subscriptions', compact('themes', 'subscriptions'));
    }


}
