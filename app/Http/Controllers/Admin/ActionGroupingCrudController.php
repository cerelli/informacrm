<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Controllers\Admin\GroupingCrudController;
use Auth;
// use App\Models\Account_type;
// use App\Models\Account;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ActionRequest as StoreRequest;
use App\Http\Requests\ActionRequest as UpdateRequest;

class ActionGroupingCrudController extends GroupingCrudController {

    public function setup() {

        parent::setup();


    }


    public function edit($parent_id, $id = null)
    {
        $result = parent::edit($id);
        $this->crud->cancelRoute = (config('backpack.base.route_prefix') . '/grouping/'.$parent_id);
        return $result;
    }

    public function edit($parent_id, $id = null)
    {
        return parent::edit($id);
    }

    public function destroy($parent_id, $id = null)
    {
        return parent::destroy($id);
    }

}
