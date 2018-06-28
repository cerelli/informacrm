<?php

namespace App\Models\Groupings;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Grouping_status extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'grouping_statuses';
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
    public function user_created_by()
    {
        return $this->belongsTo('App\User', 'created_by', 'id');
    }
    public function user_updated_by()
    {
        return $this->belongsTo('App\User', 'updated_by', 'id');
    }

    public function groupings()
    {
        return $this->belongsTo('App\Models\Groupings\Grouping','id','grouping_status_id');
    }

    public function types()
    {
        return $this->belongsToMany('App\Models\Groupings\Grouping_type',
           'grouping_status_grouping_type', 'grouping_status_id', 'grouping_type_id');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    public function scopeCountGroupings($query, $account_id){
       return $query->withCount(['groupings' => function($subquery) use ($account_id){
         return $subquery->where('account_id', $account_id);
     }])->orderBy('lft','asc');
    }

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
