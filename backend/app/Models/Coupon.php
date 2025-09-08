<?php
declare(strict_types=1);

namespace App\Models;

use App\Models\Product;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Eloquent\DocumentModel;
use MongoDB\Laravel\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use HasFactory, SoftDeletes, DocumentModel;
    protected $connection = 'mongodb';
    protected $table = 'sizes';
    protected $fillable = ['name', 'discount', 'valid_until'];
    protected $primaryKey = 'name';
    protected $keyType = 'string';
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
