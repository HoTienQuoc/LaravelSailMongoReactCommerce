<?php
declare(strict_types=1);

namespace App\Models;

use App\Models\User;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\HasMany;
use MongoDB\Laravel\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Collection;
use MongoDB\Laravel\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $connection = 'mongodb';
    protected $table = 'products';
    protected $fillable = [
        'name', 'slug', 'qty', 'price',
        'desc', 'thumbnail', 'first_image', 'second_image', 'third_image',
        'status'
    ];
    protected $keyType = 'string';
    public function colors(): BelongsToMany
    {
        return $this->belongsToMany(Color::class);
    }

    public function sizes(): BelongsToMany
    {
        return $this->belongsToMany(Size::class);
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }

    // Product.php

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    // Custom accessor
    public function getApprovedReviewsAttribute(): Collection
    {
        return $this->reviews()
            ->where('approved', 1)
            ->orderBy('created_at', 'desc')
            ->with('user')
            ->get();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
