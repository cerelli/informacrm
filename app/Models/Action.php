<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Backpack\CRUD\CrudTrait;
use App\User;
use Auth;

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

    protected static function boot()
        {
            parent::boot();

            // never let a company user see the users of other companies
            if (Auth::check() && Auth::user()->id) {
                $userId = Auth::user()->id;
                static::addGlobalScope('assigned_to', function (Builder $builder) use ($userId) {
                    $builder->where('assigned_to', $userId);
                });
            }
            // // never let a company user see the users of other companies
            // if (Auth::check() && Auth::user()->company_id) {
            //     $companyId = Auth::user()->company->id;
            //
            //     static::addGlobalScope('company_id', function (Builder $builder) use ($companyId) {
            //         $builder->where('company_id', $companyId);
            //     });
            // }
        }
    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function getShowIdLink() {
        // Replace proofAttach with the name of your field
        if (isset($this->id)) {
            return $this->id;
            // dd($this);
            // return '<a href="'.url(config('backpack.base.route_prefix', 'admin') . '/opportunity/'.$this->id).'/edit?call_url=opportunity&call=opportunity" >'.$this->id.'</a>';
            // return '<a href="'.url($this->id).'" target="_blank">Download</a>';
        }
    }

    public function getShowAccountLink() {
        // Replace proofAttach with the name of your field
        if (isset($this->account->fullname)) {
            // dd($this);
            return '<a href="'.url(config('backpack.base.route_prefix', 'admin') . '/account/'.$this->account->id).'#actions" >'.$this->account->fullname.'</a>';
            // return '<a href="'.url($this->id).'" target="_blank">Download</a>';
        }
    }
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    // public function user()
    // {
    //     return $this->hasOne('App\User','id', 'user_id');
    // }

    public function user_assigned_to()
    {
        return $this->belongsTo('App\User', 'assigned_to', 'id');
    }

    public function account()
    {
        return $this->belongsTo('App\Models\Account');
    }

    public function action_status()
    {
        return $this->belongsTo('App\Models\Action_status');
    }

    public function action_result()
    {
        return $this->belongsTo('App\Models\Action_result');
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

    public function scopeNotScheduled($query)
    {
        return $query->whereHas('action_status', function ($query) {
            $query->where('status', '=', 0);
        })
        ->where('all_day', '=', -1);
    }

    public function scopeAssignedToMe($query)
    {
        $test = $query->where('assigned_to', '==', 2);

        return $test;

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
    public function setDatetimeAttribute($value) {
        $this->attributes['start_date'] = \Date::parse($value);
    }
}
