<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Ramsey\Uuid\Uuid;

class Product extends Model
{
    protected $primaryKey = 'id';
    protected $keyType = 'uuid';
    public $incrementing = false;

//    public function category()
//    {
//        return $this->hasOne('App\Models\Category')->pluck('name');
//    }

    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Uuid::uuid4()->toString();
        });
    }
}
