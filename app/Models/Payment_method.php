<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Ramsey\Uuid\Uuid;

class Payment_method extends Model
{
    protected $primaryKey = 'id';
    protected $keyType = 'uuid';
    public $incrementing = false;

    use HasFactory;

    protected $fillable = [
        'name',
        'price',
    ];



    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Uuid::uuid4()->toString();
        });
    }

}
