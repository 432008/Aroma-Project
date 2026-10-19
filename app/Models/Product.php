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
        'gender',
        'price',
        'discount_price',
        'description',
        'top_notes',
        'heart_notes',
        'base_notes',
        'stock',
        'image',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'discount_price' => 'decimal:2',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function getFinalPriceAttribute()
    {
        return $this->discount_price ?? $this->price;
    }

    /**
     * Eager load the approved review average and count.
     */
    public function scopeWithRating($query)
    {
        return $query
            ->withAvg(
                ['reviews' => fn ($relation) => $relation->where('status', 'approved')],
                'rating'
            )
            ->withCount(
                ['reviews' => fn ($relation) => $relation->where('status', 'approved')]
            );
    }

    /**
     * Percentage saved when the product is on sale.
     */
    public function getDiscountPercentageAttribute(): ?int
    {
        if (! $this->discount_price || (float) $this->price <= 0) {
            return null;
        }

        return (int) round(
            (((float) $this->price - (float) $this->discount_price) / (float) $this->price) * 100
        );
    }
}