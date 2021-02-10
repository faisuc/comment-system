<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'comment',
        'level',
        'parent_id',
    ];

    protected $casts = [
        'parent_id' => 'integer',
        'name' => 'string',
        'comment' => 'string',
        'level' => 'integer',
    ];

    protected $appends = [
        'time_ago',
    ];

    public function getTimeAgoAttribute(): string
    {
        return $this->created_at->diffForHumans();
    }

    public function replies(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id', 'id');
    }
}
