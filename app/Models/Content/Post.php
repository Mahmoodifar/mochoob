<?php

namespace App\Models\Content;

use App\Models\Content\Comment;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, SoftDeletes, Sluggable;


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                 // update warnin badlink in seo
                // 'onUpdate' => true
            ]
        ];
    }

    protected $casts = ['image' => 'array'];

    protected $fillable = ['title','category_id','summary','body', 'slug', 'image', 'status', 'tags','published_at','author_id','commentable'];

    public function postCategory()
    {
        return $this->belongsTo(PostCategory::class, 'category_id');
    }

    public function comments()
    {
        return $this->morphMany('App\Models\Content\Comment','commentable');
    }
}
