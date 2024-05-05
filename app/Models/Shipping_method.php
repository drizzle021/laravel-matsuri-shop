<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping_method extends Model
{
    protected $primaryKey = 'id';
    protected $keyType = 'uuid';
    public $incrementing = false;

    use HasFactory;
}
