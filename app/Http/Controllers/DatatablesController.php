<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Action;

class DatatablesController extends Controller
{
    /**
    * Displays datatables front end view
    *
    * @return \Illuminate\View\View
    */
    public function getIndex()
    {
        return view('inf.accounts.tabs.actions.list');
    }

    public function getListDetails($account_id, $action_type = 0)
    {
        return view('inf.accounts.tabs.actions.list_details', ['active_account_id' => $account_id,'action_type' => $action_type]);
    }

    /**
    * Process datatables ajax request.
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function anyData($account_id, $action_type = 0)
    {

        if ( $action_type == 0 ) {
            $data = Action::where('account_id', '=', $account_id);
        } else {
            $data = Action::where('account_id', '=', $account_id)
                        ->where('action_status_id', '=', $action_type);
        }

        $data = Action::where('account_id', '=', $account_id);

        $out = Datatables::of($data)
                ->rawColumns(['notes'])
                ->make();
        return $out;
        // return Datatable::of(Action::all())->make(true);
    }
}
