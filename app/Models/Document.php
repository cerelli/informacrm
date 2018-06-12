<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Document extends Model
{
    use CrudTrait;

     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'documents';
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
    public function getShowIdLink() {
        // Replace proofAttach with the name of your field
        if (isset($this->id)) {
            return $this->id;
        }
    }

    public function getShowDescriptionLink() {
        // Replace proofAttach with the name of your field
        if (isset($this->description)) {
            // dd($this);
            return '<a href="'.url(config('backpack.base.route_prefix', 'admin') . '/document/'.$this->id).'" >'.$this->description.'</a>';
            // return '<a href="'.url($this->id).'" target="_blank">Download</a>';
        }
    }

    
    public function getShowAccountLink() {
        // Replace proofAttach with the name of your field
        if (isset($this->account->fullname)) {
            // dd($this);
            return '<a href="'.url(config('backpack.base.route_prefix', 'admin') . '/account/'.$this->account->id).'#documents" >'.$this->account->fullname.'</a>';
            // return '<a href="'.url($this->id).'" target="_blank">Download</a>';
        }
    }
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function user_updated_by()
    {
        return $this->belongsTo('App\User', 'updated_by', 'id');
    }

    public function user_created_by()
    {
        return $this->belongsTo('App\User', 'created_by', 'id');
    }

    public function user_deleted_by()
    {
        return $this->belongsTo('App\User', 'deleted_by', 'id');
    }

    public function account()
    {
        return $this->belongsTo('App\Models\Account');
    }

    public function document_status()
    {
        return $this->belongsTo('App\Models\Document_status');
    }

    public function document_type()
    {
        return $this->belongsTo('App\Models\Document_type');
    }

    public function attachments()
    {
        return $this->belongsToMany('App\Models\Attachment','attachment_document','document_id','attachment_id');
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
    public function getAcudAttribute()
    {
        $acud['assigned_to'] = $this->user_assigned_to['name'];
        $acud['assigned_by'] = $this->user_assigned_by['name'];
        $acud['assigned_at'] = $this->assigned_at;

        $acud['created_by'] = $this->user_created_by['name'];
        $acud['created_at'] = $this->created_at;

        $acud['updated_by'] = $this->user_updated_by['name'];
        $acud['updated_at'] = $this->updated_at;
        // dd($acud);
        return $acud;
    }
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    public function setExpirationDateAttribute($value)
    {
       $this->attributes['expiration_date'] = \Date::parse($value);
    }
}
