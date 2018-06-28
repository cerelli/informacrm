<?php

namespace App\Models\Groupings;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Grouping_type extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'grouping_types';
    protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['description', 'color', 'background_color', 'icon', 'created_by', 'updated_by'];
    // protected $hidden = [];
    // protected $dates = [];
    protected $appends = [
       'groupingCount'
   ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public static function menu() {
        $grouping_type_menus = Grouping_type::orderBy('lft')->get();
        // dump($grouping_type_menus);
        $menus = '';
        foreach ($grouping_type_menus as $key => $menuItem){
            $menus .= '<li><a href="'.url(config("backpack.base.route_prefix", "admin") . "/grouping?grouping_type_id=".$menuItem->id).'"><i class="fa '. $menuItem->icon .'"></i> <span>'. $menuItem->description .'</span></a></li>';

        }

        return $menus;
    }



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


    public function grouping_statuses()
    {
        return $this->belongsToMany('App\Models\Groupings\Grouping_status','grouping_status_grouping_type', 'grouping_status_id', 'grouping_type_id');
    }

    public function groupings()
    {
        return $this->belongsTo('App\Models\Groupings\Grouping','id','grouping_type_id');
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
    public function getGroupingCountAttribute()
    {
        return $this->groupings()->count();
    }
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
