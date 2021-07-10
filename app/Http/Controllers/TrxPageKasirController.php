<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrxPageKasirController extends Controller
{
    public function index(){
        // print_r($request->customer_id);
        // print_r($id);
        $kwt =DB::select('select distinct bupot_header.bupot_id,status,bupot_number,bupot_date,bupot_header.dpp_amount,percentage,bupot_header.pph_amount, (select count(*) from bupot_lines where bupot_header.bupot_id = bupot_lines.bupot_id) as "JumlahKwitansi" from bupot_header,bupot_lines,listing_kwt where bupot_header.bupot_id = bupot_lines.bupot_id and listing_kwt.kwt_id = bupot_lines.kwt_id');
        return response([
            'data' => $kwt
        ], 200);
    }

        public function cariData(Request $request){
        // $request->input('seq'),
        $data = DB::select('select distinct bupot_header.bupot_id,status,bupot_number,bupot_date,bupot_header.dpp_amount,percentage,bupot_header.pph_amount, (select count(*) from bupot_lines where bupot_header.bupot_id = bupot_lines.bupot_id) as "JumlahKwitansi" from bupot_header,bupot_lines,listing_kwt where bupot_header.bupot_id = bupot_lines.bupot_id and listing_kwt.kwt_id = bupot_lines.kwt_id and bupot_header.customer_id = '.$request->customer_id.' and bupot_date BETWEEN "'.$request->tanggal_awal.'" and "'.$request->tanggal_akhir.'" and bupot_number like "%'.$request->nomor_bupot.'%"');
        return response()->json([
            'data' => $data
        ], 200);
    }
}
