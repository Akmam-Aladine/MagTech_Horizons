<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'role'];

    public function themes(): HasMany
    {
        return $this->hasMany(Theme::class, 'manager_id');
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'proposed_by');
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

}
