<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Sell;

class SellRows extends Model
{

	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sell_rows';

    protected  $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sell_id', 'sku', 'qty', 'price', 'tax', 'tax_amount', 'sub_total',
    ];

    public function sales()
    {
        return $this->belongsTo(Sell::class, 'sell_id', 'id');
    }
}
