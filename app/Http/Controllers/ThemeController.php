<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Theme;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThemeController extends Controller
{
    public function subscribe($id): RedirectResponse
    {
        $theme = Theme::findOrFail($id);

        // Créer une nouvelle subscription
        Subscription::create([
            'user_id' => Auth::id(),
            'theme_id' => $id,
            'subscribed_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Ajouter le thème à la liste des abonnements de l'utilisateur (si nécessaire)
        //Auth::user()->themes()->attach($theme->id);

        return redirect()->back()->with('success', 'You have subscribed to the theme: ' . $theme->name);
    }

    public function unsubscribe($id): RedirectResponse
    {
        $theme = Theme::findOrFail($id);

        // Supprimer l'abonnement existant
        Subscription::where('user_id', Auth::id())
            ->where('theme_id', $id)
            ->delete();

        return redirect()->back()->with('success', 'You have unsubscribed from the theme: ' . $theme->name);
    }

}
