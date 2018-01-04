<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Nicolaslopezj\Searchable\SearchableTrait;

class Account extends Model
{
    use CrudTrait;
    use SearchableTrait;

    protected $searchable = [
        'columns' => [
            'accounts.name1' => 10,
            'accounts.name2' => 10,
            'accounts.vat_number' => 5,
            'accounts.fiscal_code' => 5,
            'accounts.notes' => 1,
            'contacts.first_name' => 5,
            'contacts.last_name' => 5,
            'contacts.notes' => 10,
            // 'profiles.bio' => 3,
            // 'profiles.country' => 2,
            // 'profiles.city' => 1,
        ],
        'joins' =>  [
            'contacts' => ['accounts.id','contacts.account_id'],
        ],
    ];

     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'accounts';
    protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = ['title_id', 'is_person', 'name1', 'name2', 'notes','from_url' ];
    // protected $hidden = [];
    // protected $dates = [];
    // protected $fakeColumns = ['extras'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function openGoogle($crud = false)
    {
        return '<a class="btn btn-xs btn-default" target="_blank" href="http://google.com?q='.urlencode($this->text).'" data-toggle="tooltip" title="Just a demo custom button."><i class="fa fa-search"></i> Google it</a>';
    }


    public function getShowAccountLink() {
        // Replace proofAttach with the name of your field
        if (isset($this->fullname)) {
            // dd($this);
            return '<a href="'.url(config('backpack.base.route_prefix', 'admin') . '/account/'.$this->id).'" >'.$this->fullname.'</a>';
            // return '<a href="'.url($this->id).'" target="_blank">Download</a>';
        }
    }
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function title()
    {
        return $this->hasOne('App\Models\Title','id', 'title_id');
    }

    public function account_types()
    {
        return $this->belongsToMany('App\Models\Account_type','account_account_type','account_id','account_type_id');
    }

    public function contacts()
    {
        return $this->hasMany('App\Models\Contact','account_id', 'id');
    }

    public function contact_details()
    {
        return $this->hasManyThrough(
            'App\Models\Contact_detail',
            'App\Models\Contact',
            'account_id', // Foreign key on contacts table...
            'contact_id', // Foreign key on contact_details table...
            'id', // Local key on accounts table...
            'id' // Local key on contacts table...
        );
    }

    public function addresses()
    {
        return $this->hasMany('App\Models\Address','account_id', 'id');
    }

    public function web_sites()
    {
        return $this->hasMany('App\Models\Web_site','account_id', 'id');
    }

    public function events()
    {
        return $this->hasMany('App\Models\Event','account_id', 'id');
    }

    public function event_types()
    {
        return $this->hasManyThrough(
            'App\Models\Event_type',
            'App\Models\Event',
            'account_id', // Foreign key on contacts table...
            'event_id', // Foreign key on contact_details table...
            'id', // Local key on accounts table...
            'id' // Local key on contacts table...
        );
    }

    public function opportunities()
    {
        return $this->hasMany('App\Models\Opportunity','account_id', 'id');
    }


    public function service_tickets()
    {
        return $this->hasMany('App\Models\Service_ticket','account_id', 'id');
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
        return trim(trim($this->name1).' '.trim($this->name2));
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

}
