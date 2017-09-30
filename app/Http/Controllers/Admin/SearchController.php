<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Auth;
use Illuminate\Http\Request;
use App\Models\Inf_account;
use App\Models\Inf_contact;

class SearchController extends CrudController
{

    public function findAccounts(Request $request)
    {
        // User::search($request->get('q'))->with('profile')->get();
        // $test = inf_account::search($request->get('q'))->get();
        // dd($test->toArray());
        // Simple search
        // $users = User::search($query)->get();

        // Search and get relations
        // It will not get the relations if you don't do this
        // $users = User::search($query)
        //     ->with('posts')
        //     ->get();
        // $results['accounts'][] = inf_account::search($request->get('q'))->distinct()->get();
        //
        // $results['contacts'][] = inf_contact::search($request->get('q'))->distinct()->get();

        // dd($results->toJson());
        return inf_account::search($request->get('q'))->distinct()->get();
    }

    public function findContacts(Request $request)
    {
        return inf_contact::search($request->get('q'))->distinct()->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        return view('search');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function autocomplete(Request $request)
    {
        // $account = Inf_account;
        //
        // $data = [
        //     'clients' => [],
        //     'contacts' => [],
        //     'invoices' => [],
        //     'quotes' => [],
        // ];
        //
        // foreach ($variable as $key => $value) {
        //     # code...
        // }

        $data = Inf_account::select("name1 as name")->where("name1","LIKE","%{$request->input('query')}%")->get();

        return response()->json($data);
    }

}
