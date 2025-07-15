<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static findOrFail(Post $postID)
 */
class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['caption', 'post_text', 'post_image', 'user_id','price'];
    public function like()
    {
        return $this->hasMany(Like::class);
    }
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
