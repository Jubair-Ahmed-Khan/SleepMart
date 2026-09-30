<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'sku',
        'short_description',
        'description',
        'regular_price',
        'selling_price',
        'cost_price',
        'stock',
        'weight',
        'thumbnail',
        'rating',
        'reviews_count',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'regular_price' => 'decimal:2',
        'selling_price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'rating' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function getDiscountPercentageAttribute(): int
    {
        if (
            $this->regular_price <= 0 ||
            $this->regular_price <= $this->selling_price
        ) {
            return 0;
        }

        return (int) round(
            (
                ($this->regular_price - $this->selling_price)
                / $this->regular_price
            ) * 100
        );
    }

    public function getThumbnailUrlAttribute(): string
    {
        if ($this->thumbnail) {
            return asset('storage/' . $this->thumbnail);
        }

        return asset('images/product-placeholder.svg');
    }
}