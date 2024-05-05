<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Category extends Model
{
    protected $primaryKey = 'id';

    protected $keyType = 'uuid';
    public $incrementing = false;

//    public function Product()
//    {
//        return $this->belongsTo('App\Models\Product', 'category_id');
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
