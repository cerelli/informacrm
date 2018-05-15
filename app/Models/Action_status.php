<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Illuminate\Support\Facades\DB;

class Action_status extends Model
{
    use CrudTrait;

     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'action_statuses';
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
    public function actions()
    {
        return $this->hasMany('App\Models\Action');
    }

    // public function actionsCount()
    // {
    //     return $this->hasMany('App\Models\Action')
    //                 ->selectRaw('action_status_id, count(action_status_id) as aggregate')
    //                 ->where('action_status_id', 1)
    //                 ->groupBy('action_status_id');
    // }
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    public function scopeCountActions($query, $account_id){
       return $query->withCount(['actions' => function($subquery) use ($account_id){
         return $subquery->where('account_id', $account_id);
     }])->orderBy('lft','asc');
    }

    
    public function scopeActionStatusOpened($query)
    {
        $actionStatusOpened[] = DB::table('action_statuses')
                                ->where('status', 0)
                                ->pluck("id");
        // return array_pluck($actionStatusClosed, 'id');
        return $actionStatusOpened;
    }

    // function scopeCountActionStatuses($account_id)
    // {
    //     $countActionStatusesAccount[] = DB::table('action_statuses')
    //                 ->leftJoin('actions', 'actions.action_status_id', '=', 'action_statuses.id')
    //                  ->select(DB::raw('count(action_status_id) as action_status_count, action_statuses.description as action_status_description'))
    //                  ->groupBy('action_status_id')
    //                  ->orderBy('action_status_count','desc')
    //                  ->where('account_id', 1)
    //                  ->get();
    //
    //     return $action_statuses;
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
