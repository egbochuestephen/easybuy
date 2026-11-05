<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // 1. Tell Laravel which columns are safe to be filled via a form
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'price',
        'image',
    ];

    // 2. Tell Laravel that every product belongs to a specific user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}