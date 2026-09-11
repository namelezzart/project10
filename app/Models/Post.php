<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property bool $published
 * @property Carbon $published_at
 */
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'published',
        'published_at',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'published_at' => 'datetime',
        'published' => 'boolean',
    ];

    public function isPublished(): bool
    {
        return $this->published
            && $this->published_at;
    }

    /**
     * Получить автора поста
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Пользователи, поставившие лайк посту
     */
    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'post_likes')->withTimestamps();
    }

    /**
     * Поставил ли указанный пользователь лайк этому посту
     */
    public function isLikedBy(?User $user): bool
    {
        if (! $user) {
            return false;
        }

        return $this->likedByUsers()->where('user_id', $user->id)->exists();
    }
}