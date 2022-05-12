<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{

	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customers';

    protected  $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
    ];

    public function bills()
    {
        return $this->hasMany('App\Model\Sell', 'customer_id', 'id');
    }

}
