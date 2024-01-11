<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function decreaseStock(int $quantity): bool
    {
        if ($this->quantity < $quantity) {
            return false;
        }

        $this->decrement('quantity', $quantity);
        return true;
    }

    public function increaseStock(int $quantity): bool
    {
        $this->increment('quantity', $quantity);
        return true;
    }
}
