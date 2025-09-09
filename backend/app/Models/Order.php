<?php
declare(strict_types=1);

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;
use MongoDB\Laravel\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    protected $connection = 'mongodb';
    protected $table = 'orders';
    protected $fillable = ['qty','total','delivered_at','user_id','coupon_id'];
    protected $keyType = 'string';
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function coupon(): BelongsTo{
        return $this->belongsTo(Coupon::class);
    }
}
