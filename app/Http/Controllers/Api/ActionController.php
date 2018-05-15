<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Action;

class ActionController extends Controller
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

            $results = Action::select('id', 'title', 'notes', DB::raw('CONCAT(id, " - ", title) AS description'))
                        ->where('title', 'LIKE', '%'.$search_term.'%')
                        ->orWhere('notes', 'LIKE', '%'.$search_term.'%')->paginate(10);
        }
        else
        {
            $results = Action::paginate(10);
        }

        return $results;
    }

    public function show($id)
    {
        return Action::find($id);
    }
}
