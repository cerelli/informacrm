<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Groupings\Grouping_status;
use App\Models\Groupings\Grouping_type;

class GroupingController extends Controller
{
    public function groupingStatuses($grouping_id)
    {
        $statuses = Grouping_type::find($grouping_id);
        $grouping_statuses = $statuses->grouping_statuses;
        return json_encode($grouping_statuses);


        $search_term = $request->input('q');
        $page = $request->input('page');
        $test = [];
        $test = ["one" => "One", "two" => "Two"];
        // dump($test);
        return $test;

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
}
