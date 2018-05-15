<?php

namespace App\Models\Groupings;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Grouping extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'groupings';
    protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    // protected static function boot()
    //     {
    //         parent::boot();
    //         $grouping_type_id = \Route::current()->parameter('account_id');
    //         static::addGlobalScope('ofType', function (Builder $builder) use ($grouping_type_id) {
    //             $builder->where('grouping_type_id', $grouping_type_id);
    //         });
    //     }
    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function getActionsTimeline($account_id, $action_status_id = null)
    {
        $data['actions'] = Action::where('account_id', '=', $account_id);
        $data['countActionStatuses'] = Action_status::countActions($account_id)->get();
        $data['countActionTypes'] = Action_type::countActions($account_id)->get();
        $data['active_account_id']['id'] = $account_id;
        // $filter = new CrudFilter($options, $values, $filter_logic);
        // $data['filter']['name'] = 'filtro1';
        if (!$action_status_id){
            //active first action_status
            $data['actions']->where('action_status_id', '=', $data['countActionStatuses'][0]->id);
            $viewReturn = 'inf.accounts.tabs.actions.actions';
        }else{
            $data['actions']->where('action_status_id', '=', $action_status_id);
            $viewReturn = 'inf.accounts.tabs.actions.details';
        }
        $data['actions'] = $data['actions']->get();
        return view($viewReturn, $data);
    }

    public function getShowAccountLink() {
        // Replace proofAttach with the name of your field
        if (isset($this->account->fullname)) {
            // dd($this);
            return '<a href="'.url(config('backpack.base.route_prefix', 'admin') . '/account/'.$this->account->id).'#actions" >'.$this->account->fullname.'</a>';
            // return '<a href="'.url($this->id).'" target="_blank">Download</a>';
        }
    }

    public function getShowTitleLink() {
        // Replace proofAttach with the name of your field
        if (isset($this->title)) {
            // dd($this);
            return '<a href="'.url(config('backpack.base.route_prefix', 'admin') . '/grouping/'.$this->id).'" >'.$this->title.'</a>';
            // return '<a href="'.url($this->id).'" target="_blank">Download</a>';
        }
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function account()
    {
        return $this->belongsTo('App\Models\Account');
    }

    public function user_assigned_to()
    {
        return $this->belongsTo('App\User', 'assigned_to', 'id');
    }

    public function user_assigned_by()
    {
        return $this->belongsTo('App\User', 'assigned_by', 'id');
    }

    public function grouping_status()
    {
        return $this->belongsTo('App\Models\Groupings\Grouping_status');
    }

    public function grouping_type()
    {
        return $this->belongsTo('App\Models\Groupings\Grouping_type');
    }

    public function user_created_by()
    {
        return $this->belongsTo('App\User', 'created_by', 'id');
    }
    public function user_updated_by()
    {
        return $this->belongsTo('App\User', 'updated_by', 'id');
    }
    public function user_deleted_by()
    {
        return $this->belongsTo('App\User', 'deleted_by', 'id');
    }

    public function actions()
    {
        return $this->morphedByMany('App\Models\Action', 'groupinggable')->withPivot('created_at')->orderBy('created_at','DESC');
    }

    public function thread()
    {
        return $this->hasMany('App\Models\Groupings\Grouping_thread', 'grouping_id');
    }



    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    public function scopeOfType($query, $grouping_type_id)
     {
         return $query->where('grouping_type_id', $grouping_type_id);
     }
    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */
    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */


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
}
