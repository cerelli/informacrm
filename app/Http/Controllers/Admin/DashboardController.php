<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Auth;
use Gate;

class DashboardController extends CrudController
{
    public function __construct(){
    // $this->middleware('permission: dashboard');
    parent::__construct();
}

    public function index() {
        $someVar = 'Some text';
        return view('vendor.backpack.base.dashboard', compact('someVar'));
    }


}
