<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Action extends Model
{
    use CrudTrait;

     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'actions';
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
    public function account()
    {
        return $this->hasOne('App\Models\Account','id', 'account_id');
    }

    public function action_status()
    {
        return $this->hasOne('App\Models\Action_status','id','action_status_id');
    }

    public function action_types()
    {
        return $this->belongsToMany('App\Models\Action_type','action_action_type','action_id','action_type_id');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    public function scopeStatusActive($query)
    {
        return $query->whereHas('action_status', function ($query) {
            $query->where('status', '=', 0);
        });
    }

    public function scopeExpired($query)
    {
        return $query->whereHas('action_status', function ($query) {
            $query->where('status', '=', 0);
        })
        ->where('end_date', '<', date("Y-m-d"));
    }
    
    // /**
    //  * Scope a query to only include active users.
    //  *
    //  * @param \Illuminate\Database\Eloquent\Builder $query
    //  * @return \Illuminate\Database\Eloquent\Builder
    //  */
    // public function scopeActions_of_account($account_id)
    // {
    //
    //     return static::with('account')->get();
    // }

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
