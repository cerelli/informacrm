<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Account;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $search_term = $request->input('q');
        $page = $request->input('page');
        // dump($page);
        if ($search_term)
        {
            // $results = Account::where('name1', 'LIKE', '%'.$search_term.'%')
            //             ->orWhere('name2', 'LIKE', '%'.$search_term.'%')->paginate(10);

            $results = Account::select('id', 'name1', 'name2', DB::raw('CONCAT(name1, " ", name2) AS full_name'))
                        ->where('name1', 'LIKE', '%'.$search_term.'%')
                        ->orWhere('name2', 'LIKE', '%'.$search_term.'%')->paginate(10);
        }
        else
        {
            $results = Account::paginate(10);
        }

        return $results;
    }

    public function show($id)
    {
        return Account::find($id);
    }
}
