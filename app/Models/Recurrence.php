<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recurrence extends Model
{
    use HasFactory;
    protected $table = "recurrences";
    protected $fillable = ['description','interval','days','is_recurrence','status'];

    /*
    public function user(){
        return $this->belongsTo(User::class);
    }
    */
}
