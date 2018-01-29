<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Controllers\Admin\ActionCrudController;
use Auth;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ActionRequest as StoreRequest;
use App\Http\Requests\ActionRequest as UpdateRequest;

class AccountActionCrudController extends ActionCrudController {

    public function setup() {
        parent::setup();

        // get the user_id parameter
        $account_id = \Route::current()->parameter('account_id');
        $id = \Route::current()->parameter('action');
        // set a different route for the admin panel buttons
        // $this->crud->setRoute("admin/account/".$account_id."#actions");
        $this->crud->setRoute("admin/account/".$account_id."/action");
        $this->crud->cancelRoute = ("admin/account/".$account_id."#actions");
        // dd($this->crud);
        // show only that user's posts
        // $this->crud->addClause('where', 'id', '==', $id);
        // dd($this->crud);
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
        // your additional operations before save here
        $request['created_by'] = Auth::user()->name;
        //***************************ORIGINAL*********
        $redirect_location = parent::storeCrud($request);
        //********************************************
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        $account_id = \Route::current()->parameter('account_id');
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
        // your additional operations before save here
        if ( $request['created_by'] == "") {
            $request['created_by'] = Auth::user()->name;
        }
        $request['updated_by'] = Auth::user()->name;

        $redirect_location = parent::updateCrud($request);

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
}
