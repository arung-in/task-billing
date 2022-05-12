<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Customers;
use App\Model\SellRows;

class Sell extends Model
{

	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sell';

    protected  $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id', 'cash', 'total_price_without_tax', 'total_tax_payable', 'net_total', 'net_total_rounded_down', 'balance_payable_to_customer',
    ];

    public function customer()
    {
        return $this->belongsTo(Customers::class);
    }

    public function sellrows()
    {
        return $this->hasMany(SellRows::class, 'sell_id', 'id');
    }
}
