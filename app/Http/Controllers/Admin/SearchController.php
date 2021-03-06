<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Auth;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Contact;
use App\Models\Action;


class SearchController extends CrudController
{

    public function findAccounts(Request $request)
    {
        // User::search($request->get('q'))->with('profile')->get();
        // $test = account::search($request->get('q'))->get();
        // dd($test->toArray());
        // Simple search
        // $users = User::search($query)->get();

        // Search and get relations
        // It will not get the relations if you don't do this
        // $users = User::search($query)
        //     ->with('posts')
        //     ->get();
        // $results['accounts'][] = account::search($request->get('q'))->distinct()->get();
        //
        // $results['contacts'][] = contact::search($request->get('q'))->distinct()->get();

        // dd($results->toJson());
        return account::search($request->get('q'))->distinct()->get();
    }

    public function findActionsInGrouping(Request $request)
    {
        return action::search($request->get('q'))->distinct()->get();
    }

    public function findContacts(Request $request)
    {
        return contact::search($request->get('q'))->distinct()->get();
    }

    // public function findSelEventOpportunity(Request $request)
    // {
    //     $result = event::whereNull('opportunity_id')
    //                 ->search($request->get('q'))
    //                 ->distinct()
    //                 ->get();
    //     // dd($result);
    //     return $result;
    //     // $data = Event::select("id","title as title")
    //     //                     ->where("title","LIKE","%{$request->input('query')}%")->get();
    //     //
    //     // return response()->json($data);
    //     // return 'pippo'; //event::search($request->get('q'))->distinct()->get();
    // }
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
        // $account = Account;
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

        $data = Account::select("name1 as name")->where("name1","LIKE","%{$request->input('query')}%")->get();

        return response()->json($data);
    }

}
