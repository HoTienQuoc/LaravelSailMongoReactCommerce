<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\HasMany;
use MongoDB\Laravel\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Collection;
use MongoDB\Laravel\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mongodb';

    protected $table = 'reviews';

    protected $fillable = [
        'title', 'body', 'user_id', 'approved',
        'rating', 'product_id'
    ];

    protected $keyType = 'string';


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }
}

