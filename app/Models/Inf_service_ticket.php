<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Inf_service_ticket extends Model
{
    use CrudTrait;

     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'inf_service_tickets';
    protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
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
    public function service_ticket_status()
    {
        return $this->hasOne('App\Models\Inf_service_ticket_status','id','inf_service_ticket_status_id');
    }

    public function service_ticket_result()
    {
        return $this->hasOne('App\Models\Inf_service_ticket_result','id','inf_service_ticket_result_id');
    }

    public function account()
    {
        return $this->hasOne('App\Models\Inf_account','id','inf_account_id');
    }

    public function service_ticket_types()
    {
        return $this->belongsToMany('App\Models\Inf_service_ticket_type','inf_service_ticket_inf_service_ticket_type','service_ticket_id','service_ticket_type_id');
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
        if ( isset($this->inf_service_ticket_result_id) && $this->inf_service_ticket_result_id > 0 ) {
            $label_service_ticket_result = '<span style="font-size: 80%; margin-right: 3px; color: '.$this->service_ticket_result->color.'; background-color: '.$this->service_ticket_result->background_color.'" class="label label-default pull-right">
                    <i class= "fa  '.$this->service_ticket_result->icon.'"></i> '.$this->service_ticket_result->description.'
                </span>';

            return $label_service_ticket_result;
        } else {
            return "";
        }
    }
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
