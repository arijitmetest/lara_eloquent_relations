<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    
    // i have added
    protected $table = 'cars';
    protected $primaryKey = 'id';

    // protected $fillable = [
    //     'member_id', 'professional_id'
    // ];
}
