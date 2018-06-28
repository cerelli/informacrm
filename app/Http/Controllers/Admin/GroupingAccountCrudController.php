<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Controllers\Admin\GroupingCrudController;
use Auth;
use App\Models\Account_type;
use App\Models\Account;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\GroupingRequest as StoreRequest;
use App\Http\Requests\GroupingRequest as UpdateRequest;

class GroupingAccountCrudController extends GroupingCrudController {

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

        $account_id = \Route::current()->parameter('account_id');
        $grouping_type_id = \Route::current()->parameter('grouping_type_id');
        $this->crud->setRoute("admin/account/".$account_id."/grouping");
        $this->crud->cancelRoute = ("admin/account/".$account_id."#grouping_".$grouping_type_id);
    }

    public function create()
    {
        $account_id = \Route::current()->parameter('account_id');
        $grouping_type_id = \Route::current()->parameter('grouping_type_id');
        if ( $account_id > 0 ) {
            $account = Account::findOrFail($account_id);
            $this->crud->entity_name = $this->crud->entity_name.' '.trans('general.to').' '.$account->getFullNameAttribute();
        } else {

        }
        $result = parent::create();
        $disabled = 'disabled';

        $this->crud->create_fields['account_id']['attributes'] = [$disabled => $disabled];
        $this->crud->create_fields['account_id']['value'] = $account_id;

        $this->crud->create_fields['grouping_type_id']['attributes'] = [$disabled => $disabled];
        $this->crud->create_fields['grouping_type_id']['value'] = $grouping_type_id;

        $this->crud->selectStatus = \App\Models\Groupings\Grouping_type::find($grouping_type_id)->grouping_statuses;
        $this->crud->setRoute("admin/account/".$account_id."/grouping/".$grouping_type_id."/grouping");
        return $result;
    }

    public function show($parent_id, $id = null)
    {
        // dd($id,$parent_id);
        $this->crud->hasAccessOrFail('show');
        $account_id = \Route::current()->parameter('account_id');
        $grouping_type_id = \Route::current()->parameter('grouping_type_id');
        // $this->crud->setRoute("admin/account/".$account_id."#grouping_".$grouping_type_id);
        $this->crud->cancelRoute = ("admin/account/".$account_id."#grouping_".$grouping_type_id);
        $view = parent::show($id);
        return $view;
    }

    public function edit($parent_id, $id = null)
    {
        $view = parent::edit($id);
        $account_id = \Route::current()->parameter('account_id');
        $grouping_type_id = \Route::current()->parameter('grouping_type_id');
        $this->crud->cancelRoute = ("admin/account/".$account_id."#grouping_".$grouping_type_id);

        $disabled = 'disabled';

        $this->crud->update_fields['account_id']['attributes'] = [$disabled => $disabled];

        $this->crud->update_fields['grouping_type_id']['attributes'] = [$disabled => $disabled];

        $this->crud->setRoute("admin/account/".$account_id."/grouping/".$grouping_type_id."/grouping");
        return $view;
    }

    public function destroy($parent_id, $id = null)
    {
        return parent::destroy($id);
    }

    public function store(StoreRequest $request)
    {
        // dd('pippo');
        // // your additional operations before save here
        // $request['created_by'] = Auth::user()->name;
        $account_id = \Route::current()->parameter('account_id');
        $request['account_id'] = $account_id;
        $request['grouping_type_id'] = $request['grouping_type_id'];
        // $request['account_id'] = $account_id;
        // //***************************ORIGINAL*********
        // $redirect_location = parent::storeCrud($request);
        // dump($request['account_id'],$request['grouping_type_id']);
        parent::store($request);

        //********************************************
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry

        // dump($request['account_id']);
        $grouping_type_id = \Route::current()->parameter('grouping_type_id');
        // $this->crud->setRoute("admin/account/".$account_id."/grouping");

        $saveAction = $this->getSaveAction()['active']['value'];

        switch ($saveAction) {
            case 'save_and_edit':
                break;
            case 'save_and_new':
                $redirect_location = redirect(config('backpack.base.route_prefix', 'admin').'/account/'.$account_id.'/grouping/'.$grouping_type_id.'/create');
                break;
            case 'save_and_back':
            default:
                $redirect_location = redirect('admin/account/'.$account_id.'#grouping_'.$grouping_type_id);
                break;
        }
        //***************************ORIGINAL********
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        parent::update($request);
        $account_id = \Route::current()->parameter('account_id');
        $grouping_type_id = \Route::current()->parameter('grouping_type_id');

        // set a different route for the admin panel buttons
        // $this->crud->setRoute("admin/account/".$account_id."/action");
        $saveAction = $this->getSaveAction()['active']['value'];
        switch ($saveAction) {
            case 'save_and_edit':
                break;
            case 'save_and_new':
                $redirect_location = redirect(config('backpack.base.route_prefix', 'admin').'/account/'.$account_id.'/grouping/'.$grouping_type_id.'/create');
                break;
            case 'save_and_back':
            default:
                $redirect_location = redirect('admin/account/'.$account_id.'#grouping_'.$grouping_type_id);
                break;
        }
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
