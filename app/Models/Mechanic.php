<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mechanic extends Model
{
    use HasFactory;

    // i have added
    protected $table = 'mechanics';
    protected $primaryKey = 'id';

    // protected $fillable = [
    //     'member_id', 'professional_id'
    // ];

    #Has One Through

    /**
     * Get the car's owner.
     */
    public function carOwner()
    {
        return $this->hasOneThrough(Owner::class, Car::class);

        // return $this->hasOneThrough(
        //     Owner::class,
        //     Car::class,
        //     'mechanic_id', // Foreign key on the cars table...
        //     'car_id', // Foreign key on the owners table...
        //     'id', // Local key on the mechanics table...
        //     'id' // Local key on the cars table...
        // );
    }
}
