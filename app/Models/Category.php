<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'slug', 'eyebrow', 'description', 'sort'])]
class Category extends Model
{
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getImageUrlAttribute(): string
    {
        $path = 'images/categories/'.$this->slug.'.jpg';

        if (is_file(public_path($path))) {
            return asset($path);
        }

        return asset('images/editorial/hero.jpg');
    }
}
