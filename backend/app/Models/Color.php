<?php
declare(strict_types=1);

namespace App\Models;

use App\Models\Product;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use MongoDB\Laravel\Eloquent\DocumentModel;
use MongoDB\Laravel\Relations\BelongsToMany;

class Color extends Model
{
    use HasFactory, SoftDeletes, DocumentModel;
    protected $connection = 'mongodb';
    protected $table = 'colors';
    protected $fillable = ['name'];
    protected $primaryKey = 'name';
    protected $keyType = 'string';
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
