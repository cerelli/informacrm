<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Auth;
use Illuminate\Http\Request;
use App\Models\Inf_account;

class SearchController extends CrudController
{

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
