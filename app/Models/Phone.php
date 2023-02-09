<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    // i have added
    protected $table = 'phones';
    protected $primaryKey = 'id';

    // protected $fillable = [
    //     'member_id', 'professional_id'
    // ];
    
    protected $guarded = [];

    # one to one relations
    /**
     * Get the user that owns the phone.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
        //return $this->belongsTo('App\Models\User');
        //return $this->belongsTo(User::class,'foreign_key','local_key');
        //return $this->belongsTo(User::class,'user_id','id');
    }
}
