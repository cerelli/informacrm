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

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
