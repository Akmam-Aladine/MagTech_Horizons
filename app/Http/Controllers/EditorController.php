<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Issue;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EditorController extends Controller
{
    /**
     * Affiche le tableau de bord de l'Éditeur.
     */
    public function show()
    {
        // Statistiques globales
        $subscribersCount = User::where('role', 'Subscriber')->count();
        $themesCount = Theme::count();
        $articlesCount = Article::count();
        $issuesCount = Issue::count();

        // Articles approuvés uniquement
        $articles = Article::with('theme')->where('status', 'Approved')->get();

        // Utilisateurs (abonnés et responsables de thèmes)
        $users = User::whereIn('role', ['Subscriber', 'Theme Manager', 'Guest'])->get();

        // Numéros
        $issues = Issue::orderBy('published_at', 'desc')->get();

        $themes = Theme::all();

        //dd($themes);

        return view('editor/editor_dashboard', compact(
            'subscribersCount',
            'themesCount',
            'articlesCount',
            'issuesCount',
            'articles',
            'users',
            'issues',
            'themes'
        ));
    }

    /**
     * Change le rôle d'un utilisateur.
     */
//    public function changeUserRole(Request $request, $id)
//    {
//        $user = User::findOrFail($id);
//        $request->validate(['role' => 'required|in:Guest,Subscriber,Theme Manager,Editor']);
//        $user->role = $request->role;
//        $user->save();
//
//        return redirect()->back()->with('success', 'User role updated successfully.');
//    }

    /**
     * Ajoute un nouvel utilisateur.
     */
    public function addUser(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:Guest,Subscriber,Theme Manager,Editor',
        ]);

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->back()->with('success', 'New user added successfully.');
    }

    /**
     * Ajoute un nouveau numéro.
     */
    public function addIssue(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Issue::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'New issue created successfully.');
    }

    /**
     * Change la visibilité publique d'un numéro.
     */
    public function toggleIssuePublic($id)
    {
        $issue = Issue::findOrFail($id);
        $issue->is_public = !$issue->is_public;
        $issue->save();

        return redirect()->back()->with('success', 'Issue visibility updated.');
    }

    /**
     * Publie un article dans un numéro.
     */
    public function publishArticleToIssue(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $request->validate(['issue_id' => 'required|exists:issues,id']);

        $article->update([
            'status' => 'Published',
            'issue_id' => $request->issue_id,
        ]);



        return redirect()->back()->with('success', 'Article published to issue successfully.');
    }

//    public function changeUserRole(Request $request, $id)
//    {
//        $request->validate([
//            'role' => 'required|in:Guest,Subscriber,Theme Manager,Editor',
//        ]);
//
//        $user = User::findOrFail($id);
//        $user->role = $request->role;
//        $user->save();
//
//        return redirect()->back()->with('success', 'User role updated successfully.');
//    }

    public function changeUserRole(Request $request, $id)
    {
     
        // Valider les données
        $request->validate([
            'role' => 'required|in:Guest,Subscriber,Theme Manager,Editor',
            'theme_id' => 'nullable|exists:themes,id', // theme_id est requis uniquement pour Theme Manager
        ]);

        // Trouver l'utilisateur
        $user = User::findOrFail($id);

        // Mettre à jour le rôle
        $user->role = $request->role;

        // Si le rôle est Theme Manager, associer un thème
        if ($request->role === 'Theme Manager') {
            // Vérifiez si un `theme_id` a été envoyé
            if (!$request->has('theme_id')) {
                return redirect()->back()->withErrors(['theme_id' => 'A theme must be selected for Theme Manager.']);
            }

            // Associer le thème à l'utilisateur
            //$user->theme_id = $request->theme_id; // Assurez-vous que la colonne `theme_id` existe dans votre table `users`.
            Theme::where('id', $request->theme_id)->update(['manager_id' => $user->id]);
        }
        // Sauvegarder les modifications
        $user->save();

        // Retourner avec un message de succès
        return redirect()->back()->with('success', 'User role updated successfully.');
    }



}
