<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\ThemeManagerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

// Page de connexion
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); // Affiche le formulaire de connexion
Route::post('/login', [AuthController::class, 'login']); // Gère la soumission du formulaire de connexion

// Page de création de compte
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register'); // Affiche le formulaire d'inscription
Route::post('/register', [AuthController::class, 'register']); // Gère la soumission du formulaire d'inscription

// Déconnexion
Route::get('/logout', [AuthController::class, 'logout'])->name('logout'); // Déconnexion de l'utilisateur

Route::get('themes/{themeId}/articles', [HomeController::class, 'showArticles']);
Route::get('issues/{issueId}/articles', [HomeController::class, 'showIssueArticles']);
Route::get('/articles/{id}', [ArticleController::class, 'show']);
Route::post('/articles/{id}/comments', [ArticleController::class, 'addComment']);
Route::post('/articles/{id}/rate', [ArticleController::class, 'rateArticle']);
Route::get('/propose-article', [ArticleController::class, 'showProposeArticleForm'])->middleware('auth');
Route::post('/propose-article', [ArticleController::class, 'submitArticle'])->middleware('auth');
Route::get('/history', [HomeController::class, 'browsingHistory'])->middleware('auth');
Route::get('/themes/{id}/subscribe', [ThemeController::class, 'subscribe'])->middleware('auth');
Route::get('/themes/{id}/unsubscribe', [ThemeController::class, 'unsubscribe'])->middleware('auth');
Route::get('/subscriptions', [HomeController::class, 'subscriptions'])->middleware('auth');
Route::get('/my-articles', [ArticleController::class, 'myArticles'])->middleware('auth');
Route::delete('/articles/{id}/delete', [ArticleController::class, 'deleteArticle'])->middleware('auth');
Route::get('/theme-manager/dashboard', [ThemeManagerController::class, 'dashboard'])->middleware('auth');
Route::post('/theme-manager/articles/{id}/approve', [ThemeManagerController::class, 'approveArticle'])->middleware('auth');
Route::post('/theme-manager/articles/{id}/reject', [ThemeManagerController::class, 'rejectArticle'])->middleware('auth');
Route::get('/theme-manager/articles/{id}', [ThemeManagerController::class, 'show'])->middleware('auth');
Route::delete('/theme-manager/comments/{id}/delete', [ThemeManagerController::class, 'delete'])->middleware('auth');
Route::get('/editor/dashboard', [EditorController::class, 'show'])->middleware('auth');
Route::post('/editor/users/{id}/change-role', [EditorController::class, 'changeUserRole'])->middleware('auth');
Route::post('/editor/users/add', [EditorController::class, 'addUser'])->middleware('auth');
Route::post('/editor/issues/add', [EditorController::class, 'addIssue'])->middleware('auth');
Route::post('/editor/issues/{id}/toggle-public', [EditorController::class, 'toggleIssuePublic'])->middleware('auth');
Route::post('/editor/articles/{id}/publish', [EditorController::class, 'publishArticleToIssue'])->middleware('auth');
Route::post('/editor/users/{id}/change-role', [EditorController::class, 'changeUserRole'])->middleware('auth');
Route::post('/editor/users/{id}/toggle', [EditorController::class, 'toggleStatus'])->name('users.toggle');
Route::delete('/editor/users/{id}/delete', [EditorController::class, 'destroy'])->name('users.destroy');
Route::post('/editor/issues/{id}/toggle', [EditorController::class, 'toggleStatus_Issues'])->name('issues.toggle');

// Route::get('/editor/issues/{id}/toggle', [EditorController::class, 'toggleStatus_Issues'])->name('issues.toggle');





