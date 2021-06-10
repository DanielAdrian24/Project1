<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListingKwtController extends Controller
{
    public function index(Request $request){
        $kwt=DB::table('listing_kwt')->whereNotIn('kwt_id', $request)->get();
        // $kwt =DB::table('listing_kwt')->get();
        $kwt = $kwt->values()->toArray();
        return response([
            'data' => $kwt
        ], 200);
    }
}

