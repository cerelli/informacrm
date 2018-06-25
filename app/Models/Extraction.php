<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Extraction extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'extractions';
    protected $primaryKey = 'id';
    public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['attachment_id', 'extracted_by', 'extracted_at', 'archived_by', 'archived_at'];
    // protected $hidden = [];
    // protected $dates = ['extracted_at', 'archived_at'];

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
    public function extracted_by()
    {
        return $this->hasOne('App\User', 'id', 'extracted_by');
    }
    //
    public function attachment()
    {
        return $this->hasOne('App\Models\Attachment', 'extraction_id', 'id');
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
    public function getExtractedAtAttribute()
    {
        if ( isset($this->attributes['extracted_at'])) {
            // dump('pippo',$this->attributes['extracted_at']);
            return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['extracted_at'])->format('d/m/Y H:i');
        }
    }
    public function getArchivedAtAttribute()
    {
        if ( isset($this->attributes['archived_at'])) {
            return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['archived_at'])->format('d/m/Y H:i');
        }
    }
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    // public function setDatetimeAttribute($value) {
    //     $this->attributes['extracted_at'] = \Date::parse($value);
    //     $this->attributes['archived_at'] = \Date::parse($value);
    // }
}
