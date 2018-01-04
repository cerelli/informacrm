<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Address extends Model
{
    use CrudTrait;

     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'addresses';
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
    public function openGoogle($crud = false)
    {
        return '<a class="btn btn-xs btn-default" target="_blank" href="http://google.com?q='.urlencode($this->text).'" data-toggle="tooltip" title="Just a demo custom button."><i class="fa fa-search"></i> Google it</a>';
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function address_types()
    {
        return $this->hasOne('App\Models\Address_type','id', 'address_type_id');
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
    public function getFormattedAddressAttribute()
    {
        $address_formatted = trim($this->address_line_1);
        if ( !empty(trim($this->street_number)) ) {
            $address_formatted .= ', '.trim($this->street_number);
        }
        if ( !empty(trim($this->address_line_2)) ) {
            $address_formatted .= '<br>'.trim($this->address_line_2);
        }
        $address_formatted .= '<br>'.trim($this->postal_code).' - '.trim($this->country);
        if ( !empty(trim($this->province)) ) {
            $address_formatted .= ' ('.trim($this->province).')';
        }
        return $address_formatted;
    }
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
