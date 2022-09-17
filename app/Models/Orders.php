<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = ['price','status','direccion_envio','stripe_id','envio_easypost_id','price_rate'];

    protected $hidden = ['updated_at','user_id','stripe_id'];

    protected $with = ['ordersProducts'];

    public function ordersProducts()
    {
        return $this->hasMany(OrdersProducts::class,'order_id');
    }
}
