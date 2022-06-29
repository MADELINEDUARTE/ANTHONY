<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackagesPrices extends Model
{
    use HasFactory;

    protected $table = "packages_prices";
    protected $fillable = ['packages_id','recurrences_id','amount','stripe_id'];

    public function recurrence(){
        return $this->belongsTo(Recurrence::class,'recurrences_id');
    }

    public function packages(){
        return $this->belongsTo(Package::class,'packages_id');
    }
}
