<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // i have added
    protected $table = 'products';
    protected $primaryKey = 'id';

    // protected $fillable = [
    //     'member_id', 'professional_id'
    // ];

    protected $guarded = [];


    #Advanced Has One Of Many Relationships

    /**
     * Get the current pricing for the product.
     */
    public function currentPricing()
    {
        return $this->hasOne(Price::class)->ofMany([
            'published_at' => 'max',
            'id' => 'max',
        ], function ($query) {
            $query->where('published_at', '<', now());
        });
    }
}
