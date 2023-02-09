<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deployment extends Model
{
    use HasFactory;

    
    // i have added
    protected $table = 'deployments';
    protected $primaryKey = 'id';

    // protected $fillable = [
    //     'member_id', 'professional_id'
    // ];
}
