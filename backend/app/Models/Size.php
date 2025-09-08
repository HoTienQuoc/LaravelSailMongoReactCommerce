<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Size extends Model
{
    protected $connection = 'mongodb';

    protected $table = 'sizes';

}
