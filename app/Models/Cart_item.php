<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Ramsey\Uuid\Uuid;


class Cart_item extends Model
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

    public function product(){
        return $this->belongsTo('App\Models\Product');
    }
}
