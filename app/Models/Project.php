<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;


    // i have added
    protected $table = 'projects';
    protected $primaryKey = 'id';

    // protected $fillable = [
    //     'member_id', 'professional_id'
    // ];

    #Has Many Through

    /**
     * Get all of the deployments for the project.
     */
    public function deployments()
    {
        return $this->hasManyThrough(Deployment::class, Environment::class);

        // return $this->hasManyThrough(
        //     Deployment::class,
        //     Environment::class,
        //     'project_id', // Foreign key on the environments table...
        //     'environment_id', // Foreign key on the deployments table...
        //     'id', // Local key on the projects table...
        //     'id' // Local key on the environments table...
        // );

    }


}
