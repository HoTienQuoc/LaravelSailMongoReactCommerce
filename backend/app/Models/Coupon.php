<?php
declare(strict_types=1);

namespace App\Models;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Str;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use HasFactory, SoftDeletes;
    protected $connection = 'mongodb';
    protected $table = 'coupons';
    protected $fillable = ['name', 'discount', 'valid_until'];
    protected $keyType = 'string';
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     * Convert the coupon name to uppercase
     */
    //Mutators: format again value of attributes, not have return only assign value
    public function setNameAttribute($value): void{
        $this->attributes['name'] = Str::upper($value);
    }

    /**
     * check if coupon is valid
     */
    public function checkIfValid(){
        if($this->valid_until > Carbon::now()){
            return true;
        }
        else{
            return false;
        }
    }


}
