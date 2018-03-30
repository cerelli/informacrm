<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Nicolaslopezj\Searchable\SearchableTrait;

class Contact extends Model
{
    use CrudTrait;
    use SearchableTrait;

    protected $searchable = [
        'columns' => [
            'contacts.first_name' => 10,
            'contacts.last_name' => 10,
            'contacts.notes' => 1,

            'contact_details.value' => 10,
            'contact_details.notes' => 5,
            // 'profiles.bio' => 3,
            // 'profiles.country' => 2,
            // 'profiles.city' => 1,
        ],
        'joins' =>  [
            'contact_details' => ['contacts.id','contact_details.contact_id'],
        ],
    ];

     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'contacts';
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
        return $this->belongsTo('App\Models\Title');
    }

    public function account()
    {
        return $this->belongsTo('App\Models\Account');
    }

    public function contact_type()
    {
        return $this->belongsTo('App\Models\Contact_type');
    }

    public function office()
    {
        return $this->belongsTo('App\Models\Office');
    }

    public function contact_details()
    {
        return $this->hasMany('App\Models\Contact_detail','contact_id', 'id');
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
