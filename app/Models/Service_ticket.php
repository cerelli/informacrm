<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Service_ticket extends Model
{
    use CrudTrait;

     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'service_tickets';
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
    public function getShowIdLink() {
        // Replace proofAttach with the name of your field
        if (isset($this->id)) {
            // dd($this);
            return '<a href="'.url(config('backpack.base.route_prefix', 'admin') . '/service_ticket/'.$this->id).'/edit?call_url=service_ticket&call=service_ticket" >'.$this->id.'</a>';
            // return '<a href="'.url($this->id).'" target="_blank">Download</a>';
        }
    }

    public function getShowAccountLink() {
        // Replace proofAttach with the name of your field
        if (isset($this->account->fullname)) {
            // dd($this);
            return '<a href="'.url(config('backpack.base.route_prefix', 'admin') . '/account/'.$this->account->id).'#service_tickets" >'.$this->account->fullname.'</a>';
            // return '<a href="'.url($this->id).'" target="_blank">Download</a>';
        }
    }
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function service_ticket_status()
    {
        return $this->hasOne('App\Models\Service_ticket_status','id','service_ticket_status_id');
    }

    public function service_ticket_result()
    {
        return $this->hasOne('App\Models\Service_ticket_result','id','service_ticket_result_id');
    }

    public function account()
    {
        return $this->hasOne('App\Models\Account','id','account_id');
    }

    public function service_ticket_types()
    {
        return $this->belongsToMany('App\Models\Service_ticket_type','service_ticket_service_ticket_type','service_ticket_id','service_ticket_type_id');
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
        if ( isset($this->service_ticket_result_id) && $this->service_ticket_result_id > 0 ) {
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
