<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;


class Cart extends Model
{
    protected $primaryKey = 'id';    
    protected $keyType = 'uuid';
    public $incrementing = false;

    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Uuid::uuid4()->toString();


        });
    }

    public function cart_items(){
        return $this->hasMany('App\Models\Cart_item');
    }
}
