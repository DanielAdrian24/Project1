<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrxPageValidatorController extends Controller
{
    public function index(){
        // print_r($request->customer_id);
        // print_r($id);
        $kwt =DB::select('select distinct bupot_header.bupot_id,sys_customers.id,sys_customers.customer_name,bupot_number,bupot_date,bupot_header.dpp_amount,percentage,bupot_header.pph_amount, (select count(*) from bupot_lines where bupot_header.bupot_id = bupot_lines.bupot_id) as "JumlahKwitansi" from bupot_header,bupot_lines,listing_kwt,sys_customers where bupot_header.bupot_id = bupot_lines.bupot_id and listing_kwt.kwt_id = bupot_lines.kwt_id and sys_customers.id=bupot_header.customer_id and status = "S"');
        return response([
            'data' => $kwt
        ], 200);
    }

    public function cariData(Request $request){
        $data = DB::select('select distinct bupot_header.bupot_id,sys_customers.id,sys_customers.customer_name,bupot_number,bupot_date,bupot_header.dpp_amount,percentage,bupot_header.pph_amount, (select count(*) from bupot_lines where bupot_header.bupot_id = bupot_lines.bupot_id) as "JumlahKwitansi" from bupot_header,bupot_lines,listing_kwt,sys_customers where bupot_header.bupot_id = bupot_lines.bupot_id and listing_kwt.kwt_id = bupot_lines.kwt_id  and sys_customers.id=bupot_header.customer_id and status = "S" and sys_customers.customer_name = "'.$request->customer_name.'" and bupot_date BETWEEN "'.$request->tanggal_awal.'" and "'.$request->tanggal_akhir.'" and bupot_number like "%'.$request->nomor_bupot.'%"');
        return response()->json([
            'data' => $data
        ], 200);
    }

    public function validasiData(Request $request){
        $validasi = DB::table('bupot_header')->whereIn('bupot_id',$request)->update([
            'status' => "V"
        ]);
    }

    public function tolakData(Request $request){
        $validasi = DB::table('bupot_header')->whereIn('bupot_id',$request->id_tolak)->update([
            'status' => "R",
            'reason' => $request->reason
        ]);
        return response()->json([
            'message' => "Bukti Potong Berhasil Ditolak"
        ], 200);
    }
}
