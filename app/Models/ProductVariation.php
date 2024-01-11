<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class ProductVariation extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasRecursiveRelationships;

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($variation) {
            $variation->order = ProductVariation::where('product_id', $variation->product_id)->max('order') + 1;
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function parent()
    {
        return $this->belongsTo(ProductVariation::class, 'parent_id');
    }

    public function stock()
    {
        return $this->hasOne(Stock::class, 'variant_id');
    }
}
