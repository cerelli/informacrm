<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Controllers\Admin\ActionCrudController;
use Auth;
use App\Models\Account_type;
use App\Models\Account;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ActionRequest as StoreRequest;
use App\Http\Requests\ActionRequest as UpdateRequest;

class ActionAccountCrudController extends ActionCrudController {

    public function setup() {

        parent::setup();

        $this->crud->addFilter([ // select2_multiple filter
            'name' => 'account_types',
            'type' => 'select2_multiple',
            'label'=> trans('informacrm.account_types')
        ], function() { // the options that show up in the select2
            return Account_type::all()->pluck('description', 'id')->toArray();
        }, function($values) { // if the filter is active
            foreach (json_decode($values) as $key => $value) {
                $this->crud->query = $this->crud->query->whereHas('account_types', function ($query) use ($value) {
                    $query->where('account_type_id', $value);
                });
            }
        });
        // dump($this->crud);
        // get the user_id parameter
        $account_id = \Route::current()->parameter('account_id');

        $id = \Route::current()->parameter('action');
        // set a different route for the admin panel buttons
        // $this->crud->setRoute("admin/account/".$account_id."#actions");
        $this->crud->setRoute("admin/account/".$account_id."/action");
        $this->crud->cancelRoute = ("admin/account/".$account_id."#actions");
    }

    public function create()
    {
        $account_id = \Route::current()->parameter('account_id');
        if ( $account_id > 0 ) {
            $account = Account::findOrFail($account_id);
            $this->crud->entity_name = $this->crud->entity_name.' '.trans('general.to').' '.$account->getFullNameAttribute();
        } else {

        }
        return parent::create();
    }

    public function show($parent_id, $id = null)
    {
        // dd($id,$parent_id);
        $this->crud->hasAccessOrFail('show');
        $this->crud->setRoute("admin/account/".$parent_id."#action");
        // $this->crud->cancelRoute = ("admin/account/".$account_id."#actions");
        $view = parent::show($id);
        return $view;
    }

    public function edit($parent_id, $id = null)
    {
        return parent::edit($id);
    }

    public function destroy($parent_id, $id = null)
    {
        return parent::destroy($id);
    }

    public function store(StoreRequest $request)
    {
        // // your additional operations before save here
        // $request['created_by'] = Auth::user()->name;
        $account_id = \Route::current()->parameter('account_id');
        $request['account_id'] = $account_id;
        // //***************************ORIGINAL*********
        // $redirect_location = parent::storeCrud($request);
        parent::store($request);
        //********************************************
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry

        // dump($request['account_id']);
        $action_id = \Route::current()->parameter('action');
        $saveAction = $this->getSaveAction()['active']['value'];
        switch ($saveAction) {
            case 'save_and_edit':
                break;
            case 'save_and_new':
                $redirect_location = redirect(config('backpack.base.route_prefix', 'admin').'/account/'.$account_id.'/'.$action_id.'/create');
                break;
            case 'save_and_back':
            default:
                $redirect_location = redirect('admin/account/'.$account_id.'#actions');
                break;
        }
        //***************************ORIGINAL********
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        parent::update($request);
        $account_id = \Route::current()->parameter('account_id');
        $action_id = \Route::current()->parameter('action');
        // set a different route for the admin panel buttons
        $this->crud->setRoute("admin/account/".$account_id."/action");
        $saveAction = $this->getSaveAction()['active']['value'];
        switch ($saveAction) {
            case 'save_and_edit':
                break;
            case 'save_and_new':
                $redirect_location = redirect(config('backpack.base.route_prefix', 'admin').'/account/'.$account_id.'/'.$action_id.'/create');
                break;
            case 'save_and_back':
            default:
                $redirect_location = redirect('admin/account/'.$account_id.'#actions');
                break;
        }
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
    // public function update(UpdateRequest $request)
    // {
    //     // your additional operations before save here
    //     if ( $request['created_by'] == "") {
    //         $request['created_by'] = Auth::user()->name;
    //     }
    //     $request['updated_by'] = Auth::user()->name;
    //     list($dateStart, $timeStart) = explode(' ', $request['start_date']);
    //
    //     if ( $request['all_day'] == 0 ) {
    //
    //     } else {
    //         $request['start_date'] = $dateStart;
    //         $request['end_date'] = $dateStart." 23:59:59";
    //     }
    //
    //     $redirect_location = parent::updateCrud($request);
    //
    //     $account_id = \Route::current()->parameter('account_id');
    //     $action_id = \Route::current()->parameter('action');
    //     // set a different route for the admin panel buttons
    //     $this->crud->setRoute("admin/account/".$account_id."/action");
    //     $saveAction = $this->getSaveAction()['active']['value'];
    //     switch ($saveAction) {
    //         case 'save_and_edit':
    //             break;
    //         case 'save_and_new':
    //             $redirect_location = redirect(config('backpack.base.route_prefix', 'admin').'/account/'.$account_id.'/'.$action_id.'/create');
    //             break;
    //         case 'save_and_back':
    //         default:
    //             $redirect_location = redirect('admin/account/'.$account_id.'#actions');
    //             break;
    //     }
    //     // your additional operations after save here
    //     // use $this->data['entry'] or $this->crud->entry
    //     return $redirect_location;
    // }
}
