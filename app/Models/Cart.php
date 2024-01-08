<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = [];

//    public function add($cartID, $quantity, $productID, $variant = null)
//    {
//        $item = $this->items()->where('cart_id', $cartID)
//                                ->where('product_id', $productID)
//                                ->where('variant', $variant)
//                                ->first();
//
//        if ($item) {
//            $item->quantity += $quantity;
//            $item->save();
//        } else {
//            $this->items()->create([
//                'product_id' => $productID,
//                'quantity' => $quantity,
//                'variant' => $variant,
//            ]);
//        }
//    }

    public static function booted()
    {
        static::creating(function ($cart) {
            $cart->cart_id = Str::uuid();
        });
    }

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
