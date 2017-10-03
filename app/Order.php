<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amount_usd', 'total', 'surchange', 'discount_amount', 'discount_percentage', 'grand_total', 'currency_purshased', 'surchange_percentage',
    ];

    public function customer() {
        return $this->belongsTo('App\Customer');
    }
}
