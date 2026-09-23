<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'category_id',
    'name',
    'slug',
    'subtitle',
    'description',
    'story',
    'ingredients',
    'how_to',
    'price',
    'compare_price',
    'stock',
    'sku',
    'is_featured',
    'is_bestseller',
    'badge',
    'image',
])]
class Product extends Model
{
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected function casts(): array
    {
        return [
            'price' => 'integer',
            'compare_price' => 'integer',
            'stock' => 'integer',
            'is_featured' => 'boolean',
            'is_bestseller' => 'boolean',
        ];
    }

    protected function imageUrl(): Attribute
    {
        return Attribute::get(function (): string {
            if (! $this->image) {
                return asset('brand/mark.png');
            }

            if (str_starts_with($this->image, 'images/') || str_starts_with($this->image, 'brand/')) {
                return asset($this->image);
            }

            return asset('storage/'.$this->image);
        });
    }

    public function inStock(): bool
    {
        return $this->stock > 0;
    }
}
