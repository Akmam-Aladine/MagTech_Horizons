<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Issue extends Model
{
    protected $fillable = ['title', 'description', 'published_at', 'is_public'];

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class, 'article_issue');
    }
}
