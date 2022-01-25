<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Program
 *
 * @property $id
 * @property $name
 * @property $description
 * @property $program_category_id
 * @property $video
 * @property $number_of_days
 * @property $image
 * @property $popular
 * @property $recommended
 * @property $status_id
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property ProgramCategory $programCategory
 * @property Status $status
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Program extends Model
{
    use SoftDeletes;

    static $rules = [
		'name' => 'required',
		'description' => 'required',
		'program_category_id' => 'required',
		'video' => 'required',
		'number_of_days' => 'required',
		'image' => 'required',
		'status_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description','program_category_id','video','number_of_days','image','popular','recommended','status_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function programCategory()
    {
        return $this->hasOne('App\Models\ProgramCategory', 'id', 'program_category_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function status()
    {
        return $this->hasOne('App\Models\Status', 'id', 'status_id');
    }
    

}
