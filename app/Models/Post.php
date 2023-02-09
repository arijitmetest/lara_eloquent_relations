<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $primaryKey = 'id';

    // protected $fillable = [
    //     'member_id', 'professional_id'
    // ];

    protected $guarded = [];


    // i have added
    #one to many
    /**
     * Get the comments for the blog post.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);

        //return $this->hasMany('App\Models\Comment');
        //return $this->hasMany(Comment::class,'foreign_key','local_key');
        //return $this->hasMany(Comment::class,'post_id','id');
    }
    
    #Default Models

    //The belongsTo, hasOne, hasOneThrough, and morphOne relationships allow you to define a default model
    // that will be returned if the given relationship is null. This pattern is often referred
    // to as the Null Object pattern and can help remove conditional checks in your code.
    // In the following example, the user relation will return an empty App\Models\User model
    // if no user is attached to the Post model:
    // public function user()
    // {
    //     return $this->belongsTo(User::class);

    //     //return $this->belongsTo(User::class)->withDefault();

    //     // return $this->belongsTo(User::class)->withDefault([
    //     //     'name' => 'User One',
    //     // ]);

    //     // return $this->belongsTo(User::class)->withDefault(function ($user, $post) {
    //     //     $user->name = 'User One';
    //     // });

    //     // return $this->belongsTo(User::class)->withDefault(function ($user, $post) {
    //     //     $user->name = 'User One';
    //     // });
    // }
}
