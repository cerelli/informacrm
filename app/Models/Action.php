<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Backpack\CRUD\CrudTrait;
use Nicolaslopezj\Searchable\SearchableTrait;
use App\User;
use Auth;

class Action extends Model
{
    use CrudTrait;
    use SearchableTrait;
    use \Venturecraft\Revisionable\RevisionableTrait;

    protected $searchable = [
        'columns' => [
            'actions.id' => 10,
            'actions.title' => 10,
            'actions.notes' => 10,
        ],
        // 'joins' =>  [
        //     'contacts' => ['accounts.id','contacts.account_id'],
        // ],
    ];

     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
    // protected $casts = [
    //     'created_at' => 'datetime:d/m/Y H:m',
    // ];

    protected $table = 'actions';
    protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];
    protected $revisionCleanup = true;
    protected $revisionCreationsEnabled = true;
    protected $historyLimit = 200;


    protected static function boot()
        {
            parent::boot();
            // never let a company user see the users of other companies
            if (Auth::check() && Auth::user()->id) {
                if ( Auth::user()->hasPermissionTo('show actions of all users') ) {
                    // $this->crud->addClause('withoutGlobalScopes');
                }else{
                    $userId = Auth::user()->id;
                    static::addGlobalScope('assigned_to', function (Builder $builder) use ($userId) {
                        $builder->where('assigned_to', $userId);
                    });
                }
            }
        }
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

    public function getShowAccountLink() {
        // Replace proofAttach with the name of your field
        if (isset($this->account->fullname)) {
            // dd($this);
            return '<a href="'.url(config('backpack.base.route_prefix', 'admin') . '/account/'.$this->account->id).'#actions" >'.$this->account->fullname.'</a>';
            // return '<a href="'.url($this->id).'" target="_blank">Download</a>';
        }
    }



    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    // public function user()
    // {
    //     return $this->hasOne('App\User','id', 'user_id');
    // }

    // public function lastAssignedTo()
    // {
    //     return $this->hasMany('\Venturecraft\Revisionable\Revision', 'revisionable_id', 'id')->select(['id', 'new_value as test'])
    //         ->where('revisionable_type','=', 'actions')
    //         ->where('key','=', 'assigned_to')
    //         ->latest()
    //         ;
    // }

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

    public function user_assigned_to()
    {
        return $this->belongsTo('App\User', 'assigned_to', 'id');
    }

    public function user_assigned_by()
    {
        return $this->belongsTo('App\User', 'assigned_by', 'id');
    }

    public function account()
    {
        return $this->belongsTo('App\Models\Account');
    }

    public function action_status()
    {
        return $this->belongsTo('App\Models\Action_status');
    }

    public function action_result()
    {
        return $this->belongsTo('App\Models\Action_result');
    }

    public function action_types()
    {
        return $this->belongsToMany('App\Models\Action_type','action_action_type','action_id','action_type_id');
    }

    public function grouping()
    {
        return $this->morphToMany('App\Models\Groupings\Grouping', 'groupinggable');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    public function scopeStatusActive($query)
    {
        return $query->whereHas('action_status', function ($query) {
            $query->where('status', '=', 0);
        });
    }

    public function scopeExpired($query)
    {
        return $query->whereHas('action_status', function ($query) {
            $query->where('status', '=', 0);
        })
        ->where('end_date', '<', date("Y-m-d"));
    }

    public function scopeNotScheduled($query)
    {
        return $query->whereHas('action_status', function ($query) {
            $query->where('status', '=', 0);
        })
        ->where('all_day', '=', -1);
    }

    public function scopeAssignedToUser($query, $userId)
    {
        $test = $query->where('assigned_to', $userId);
        return $test;
    }
    // /**
    //  * Scope a query to only include active users.
    //  *
    //  * @param \Illuminate\Database\Eloquent\Builder $query
    //  * @return \Illuminate\Database\Eloquent\Builder
    //  */
    // public function scopeActions_of_account($account_id)
    // {
    //
    //     return static::with('account')->get();
    // }

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */
    public function getFullNameAccountAttribute()
    {
        return trim(trim($this->name1).' '.trim($this->name2));
    }

    public function getDescriptionAttribute()
    {
        return $this->id.' - '.$this->title;
    }

    public function getCreatedAtAttribute()
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['created_at'])->format('d/m/Y H:i');
    }

    public function getUpdatedAtAttribute()
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['updated_at'])->format('d/m/Y H:i');
    }

    public function getAssignedAtAttribute()
    {
        if ( isset($this->attributes['assigned_at'])) {
            return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['assigned_at'])->format('d/m/Y H:i');
        }
        return null;
    }

    // public function getGroupedAtAttribute()
    // {
    //     if ( isset($this->pivot->created_at)) {
    //         return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->pivot->created_at)->format('d/m/Y H:i');
    //     }
    //     return 'pippo';
    // }

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
    public function setDatetimeAttribute($value) {
        $this->attributes['start_date'] = \Date::parse($value);
    }
}
