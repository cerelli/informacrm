<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Inf_account extends Model
{
    use CrudTrait;

     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'inf_accounts';
    protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = ['inf_title_id', 'is_person', 'name1', 'name2', 'notes','from_url' ];
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
        return $this->hasOne('App\Models\Inf_title','id', 'inf_title_id');
    }

    public function account_types()
    {
        return $this->belongsToMany('App\Models\Inf_account_type','inf_account_inf_account_type','account_id','account_type_id');
    }

    public function contacts()
    {
        return $this->hasMany('App\Models\Inf_contact','inf_account_id', 'id');
    }

    public function contact_details()
    {
        return $this->hasManyThrough(
            'App\Models\Inf_contact_detail',
            'App\Models\Inf_contact',
            'inf_account_id', // Foreign key on contacts table...
            'inf_contact_id', // Foreign key on contact_details table...
            'id', // Local key on accounts table...
            'id' // Local key on contacts table...
        );
    }

    public function addresses()
    {
        return $this->hasMany('App\Models\Inf_address','inf_account_id', 'id');
    }

    public function web_sites()
    {
        return $this->hasMany('App\Models\Inf_web_site','inf_account_id', 'id');
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
