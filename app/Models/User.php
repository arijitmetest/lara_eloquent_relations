<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
//use Laravel\Sanctum\HasApiTokens; //dont needed sanctum, we will use passport

use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];


    // i have added

    # one to one relations
    /**
     * Get the phone associated with the user.
     */
    public function phone()
    {
        return $this->hasOne(Phone::class);
        //return $this->hasOne('App\Models\Phone');
        //return $this->hasOne(Phone::class,'foreign_key','local_key');
        //return $this->hasOne(Phone::class,'user_id','id');
    }


    #Has One Of Many
    /**
     * Get the user's most recent order.
     */
    // sort by id
    public function latestOrder()
    {
        return $this->hasOne(Order::class)->latestOfMany();
    }

    /**
     * Get the user's oldest order.
     */
    // sort by id
    public function oldestOrder()
    {
        return $this->hasOne(Order::class)->oldestOfMany();
    }


    //For example, using the ofMany method, you may retrieve the user's most expensive order. 
    //The ofMany method accepts the sortable column as its first argument and which aggregate 
    //function (min or max) to apply when querying for the related model:

    // Because PostgreSQL does not support executing the MAX function against UUID columns, 
    //it is not currently possible to use one-of-many relationships in combination with 
    //PostgreSQL UUID columns.

    /**
     * Get the user's largest order.
     */
    public function largestOrder()
    {
        return $this->hasOne(Order::class)->ofMany('price', 'max');
    }


    #Many To Many Relationships, table used users, roles, user_role
     /**
     * The roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);

        //return $this->belongsToMany(Role::class, 'role_user');

        //return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');

        //return $this->belongsToMany(Role::class)->withTimestamps();
    }


    
    public function posts()
    {
        return $this->hasMany(Post::class);
        //return $this->hasMany('App\Models\Post');
        //return $this->hasMany(Post::class,'foreign_key','local_key');
        //return $this->hasMany(Post::class,'user_id','id');
    }

}
