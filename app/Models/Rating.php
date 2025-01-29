<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'article_id',
        'rating',
    ];

    /**
     * Relation : Une évaluation appartient à un utilisateur.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation : Une évaluation appartient à un article.
     */
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }
}
