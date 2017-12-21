<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Inf_opportunity extends Model
{
    use CrudTrait;

     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'inf_opportunities';
    protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [''];
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
            return '<a href="'.url(config('backpack.base.route_prefix', 'admin') . '/opportunity/'.$this->id).'/edit?call_url=opportunity&call=opportunity" >'.$this->id.'</a>';
            // return '<a href="'.url($this->id).'" target="_blank">Download</a>';
        }
    }

    public function getShowAccountLink() {
        // Replace proofAttach with the name of your field
        if (isset($this->account->fullname)) {
            // dd($this);
            return '<a href="'.url(config('backpack.base.route_prefix', 'admin') . '/account/'.$this->account->id).'#opportunities" >'.$this->account->fullname.'</a>';
            // return '<a href="'.url($this->id).'" target="_blank">Download</a>';
        }
    }

    public function getValue() {
        return number_format($this->value, 2, ',', '.');
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function opportunity_status()
    {
        return $this->hasOne('App\Models\Inf_opportunity_status','id','inf_opportunity_status_id');
    }

    public function opportunity_result()
    {
        return $this->hasOne('App\Models\Inf_opportunity_result','id','inf_opportunity_result_id');
    }

    public function account()
    {
        return $this->hasOne('App\Models\Inf_account','id','inf_account_id');
    }

    public function events()
    {
        return $this->hasMany('App\Models\Inf_event','inf_opportunity_id','id');
    }

    public function opportunity_types()
    {
        return $this->belongsToMany('App\Models\Inf_opportunity_type','inf_opportunity_inf_opportunity_type','opportunity_id','opportunity_type_id');
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
        if ( isset($this->inf_opportunity_result_id) && $this->inf_opportunity_result_id > 0 ) {
            $label_opportunity_result = '<span style="font-size: 80%; margin-right: 3px; color: '.$this->opportunity_result->color.'; background-color: '.$this->opportunity_result->background_color.'" class="label label-default pull-right">
                    <i class= "fa  '.$this->opportunity_result->icon.'"></i> '.$this->opportunity_result->description.'
                </span>';

            return $label_opportunity_result;
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
