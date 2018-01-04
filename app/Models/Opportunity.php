<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Opportunity extends Model
{
    use CrudTrait;

     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'opportunities';
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
        return $this->hasOne('App\Models\Opportunity_status','id','opportunity_status_id');
    }

    public function opportunity_result()
    {
        return $this->hasOne('App\Models\Opportunity_result','id','opportunity_result_id');
    }

    public function account()
    {
        return $this->hasOne('App\Models\Account','id','account_id');
    }

    public function events()
    {
        return $this->hasMany('App\Models\Event','opportunity_id','id');
    }

    public function opportunity_types()
    {
        return $this->belongsToMany('App\Models\Opportunity_type','opportunity_opportunity_type','opportunity_id','opportunity_type_id');
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
        if ( isset($this->opportunity_result_id) && $this->opportunity_result_id > 0 ) {
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
