<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // i have added    
    protected $table = 'comments';
    protected $primaryKey = 'id';

    // protected $fillable = [
    //     'member_id', 'professional_id'
    // ];
    
    protected $guarded = [];

    #one to many, here will use comment belongsTo because one post has one single user
     /**
     * Get the post that owns the comment.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
        
        //return $this->belongsTo('App\Models\Post');
        //return $this->belongsTo(Post::class,'foreign_key','local_key');
        //return $this->belongsTo(Post::class,'post_id','id');
    }
}
