<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_path',
    ];

    protected $appends = [
        'full_image_path',
        'created_before',
    ];

//    protected $with = [
//        'comments',
//    ];

    public function getFullImagePathAttribute()
    {
        return url('storage/images/'. $this->image_path);
    }

    public function getCreatedBeforeAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }
}
