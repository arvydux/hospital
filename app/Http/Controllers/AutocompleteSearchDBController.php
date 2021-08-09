<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use App\Models\Patient;
use Illuminate\Http\Request;

class AutocompleteSearchDBController extends Controller
{
    public function searchDB(Request $request)
    {
        $search = $request->get('term');

        $result = Drug::where('name', 'LIKE', '%'. $search. '%')->get();

        return response()->json($result);

    }
}
