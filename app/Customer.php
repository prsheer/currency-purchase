<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'email',
    ];

    public function orders() {
        return $this->hasMany('App\Order');
    }
}
