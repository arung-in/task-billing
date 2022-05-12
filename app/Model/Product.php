<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    protected  $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sku', 'name', 'stock', 'price', 'tax',
    ];
}
