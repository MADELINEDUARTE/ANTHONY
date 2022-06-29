<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackagesPrices extends Model
{
    use HasFactory;

    public function recurrence(){
        return $this->belongsTo(Recurrence::class,'recurrences_id');
    }
}
