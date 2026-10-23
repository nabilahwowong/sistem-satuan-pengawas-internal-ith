<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsArticle extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // Relasi ke Penulis
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
