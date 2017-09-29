<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Nicolaslopezj\Searchable\SearchableTrait;

class Inf_contact extends Model
{
    use CrudTrait;
    use SearchableTrait;

    protected $searchable = [
        'columns' => [
            'inf_contacts.first_name' => 10,
            'inf_contacts.last_name' => 10,
            'inf_contacts.notes' => 1,

            'inf_contact_details.value' => 10,
            'inf_contact_details.notes' => 5,
            // 'profiles.bio' => 3,
            // 'profiles.country' => 2,
            // 'profiles.city' => 1,
        ],
        'joins' =>  [
            'inf_contact_details' => ['inf_contacts.id','inf_contact_details.inf_contact_id'],
        ],
    ];

     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'inf_contacts';
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
    public function title()
    {
        return $this->hasOne('App\Models\Inf_title','id','inf_title_id');
    }

    public function account()
    {
        return $this->hasOne('App\Models\Inf_account','id','inf_account_id');
    }

    public function contact_type()
    {
        return $this->hasOne('App\Models\Inf_contact_type','id','inf_contact_type_id');
    }

    public function office()
    {
        return $this->hasOne('App\Models\Inf_office','id','inf_office_id');
    }

    public function contact_details()
    {
        return $this->hasMany('App\Models\Inf_contact_detail','inf_contact_id', 'id');
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
    public function getFullNameAttribute()
    {
        return trim(trim($this->first_name).' '.trim($this->last_name));
    }
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
