<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Inf_event extends Model
{
    use CrudTrait;

     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'inf_events';
    protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = ['title','start_date','end_date', 'type'];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function event_status()
    {
        return $this->hasOne('App\Models\Inf_event_status','id','inf_event_status_id');
    }

    public function event_result()
    {
        return $this->hasOne('App\Models\Inf_event_result','id','inf_event_result_id');
    }

    public function account()
    {
        return $this->hasOne('App\Models\Inf_account','id','inf_account_id');
    }

    public function event_types()
    {
        return $this->belongsToMany('App\Models\Inf_event_type','inf_event_inf_event_type','event_id','event_type_id');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */
    public function getFullResultAttribute()
    {
        if ( isset($this->inf_event_result_id) && $this->inf_event_result_id > 0 ) {
            $label_event_result = '<span style="font-size: 80%; margin-right: 3px; color: '.$this->event_result->color.'; background-color: '.$this->event_result->background_color.'" class="label label-default pull-right">
                    <i class= "fa  '.$this->event_result->icon.'"></i> '.$this->event_result->description.'
                </span>';

            return $label_event_result;
        } else {
            return "";
        }
    }

    public function getFullStartEndAttribute()
    {
        return trim(trim($this->name1).' '.trim($this->name2));
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
