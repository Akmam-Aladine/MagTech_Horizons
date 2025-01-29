<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BrowsingHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'article_id',
        'viewed_at',
    ];

    public $timestamps = false;

    /**
     * Relation avec l'article.
     */
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * Relation avec l'utilisateur.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
