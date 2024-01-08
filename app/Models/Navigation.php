<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    use HasFactory;

    protected static $unguarded = true;

    protected $casts = [
        'items' => 'array',
        'items_sidebar' => 'array'
    ];
}
