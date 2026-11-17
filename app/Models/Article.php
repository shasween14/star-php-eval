<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\RouteKey;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'category_id',
    'title',
    'summary',
    'body',
    'author',
    'status',
    'permalink',
    'published_at'
])]

#[RouteKey('permalink')]
class Article extends Model
{
    use HasFactory;

    const PUBLISHED = 1;
    const DRAFT = 0;

    protected function casts(): array
    {
        return [
            "status" => 'integer',
            "published_at" => 'datetime',
        ];
    }

    #[Scope]
    protected function published(Builder $query): void
    {
        $query->where('status', self::PUBLISHED);
    }

    /**
     * Get the category that owns the Article
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
