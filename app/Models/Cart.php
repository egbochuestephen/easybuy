<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // 1. Tell Laravel which columns are safe to fill
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    // 2. Tell Laravel that every cart item belongs to a specific product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // 3. Tell Laravel that every cart item belongs to a specific user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}