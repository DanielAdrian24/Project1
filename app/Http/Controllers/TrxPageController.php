<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\BupotHeader;
use App\BupotLines;

class TrxPageController extends Controller
{
    public function index($id){
        // print_r($request->customer_id);
        // print_r($id);
        $kwt =DB::select('select distinct bupot_header.bupot_id,status,bupot_number,bupot_date,bupot_header.dpp_amount,percentage,bupot_header.pph_amount, (select count(*) from bupot_lines where bupot_header.bupot_id = bupot_lines.bupot_id) as "JumlahKwitansi" from bupot_header,bupot_lines,listing_kwt where bupot_header.bupot_id = bupot_lines.bupot_id and listing_kwt.kwt_id = bupot_lines.kwt_id and bupot_header.customer_id = '.$id);
        return response([
            'data' => $kwt
        ], 200);
    }

    public function cariData(Request $request){
        // $request->input('seq'),
        if (!empty($request->tanggal_awal)){
            $data = DB::select('select distinct bupot_header.bupot_id,status,bupot_number,bupot_date,bupot_header.dpp_amount,percentage,bupot_header.pph_amount, (select count(*) from bupot_lines where bupot_header.bupot_id = bupot_lines.bupot_id) as "JumlahKwitansi" from bupot_header,bupot_lines,listing_kwt where bupot_header.bupot_id = bupot_lines.bupot_id and listing_kwt.kwt_id = bupot_lines.kwt_id and bupot_header.customer_id = '. $request->cust_id .' and bupot_date BETWEEN "'.$request->tanggal_awal.'" and "'.$request->tanggal_akhir.'" and bupot_number like "%'.$request->nomor_bupot.'%"');
        }
        else if(empty($request->nomor_bupot) && !empty($request->tanggal_awal && !empty($request->tanggal_akhir))){
            $data = DB::select('select distinct bupot_header.bupot_id,status,bupot_number,bupot_date,bupot_header.dpp_amount,percentage,bupot_header.pph_amount, (select count(*) from bupot_lines where bupot_header.bupot_id = bupot_lines.bupot_id) as "JumlahKwitansi" from bupot_header,bupot_lines,listing_kwt where bupot_header.bupot_id = bupot_lines.bupot_id and listing_kwt.kwt_id = bupot_lines.kwt_id and bupot_header.customer_id = '. $request->cust_id .' and bupot_date BETWEEN "'.$request->tanggal_awal.'" and "'.$request->tanggal_akhir);
        }
        else{
            $data = DB::select('select distinct bupot_header.bupot_id,status,bupot_number,bupot_date,bupot_header.dpp_amount,percentage,bupot_header.pph_amount, (select count(*) from bupot_lines where bupot_header.bupot_id = bupot_lines.bupot_id) as "JumlahKwitansi" from bupot_header,bupot_lines,listing_kwt where bupot_header.bupot_id = bupot_lines.bupot_id and listing_kwt.kwt_id = bupot_lines.kwt_id and bupot_header.customer_id = '. $request->cust_id .' and bupot_number like "%'.$request->nomor_bupot.'%"');
        }
        // $data = DB::select('select distinct bupot_header.bupot_id,status,bupot_number,bupot_date,bupot_header.dpp_amount,percentage,bupot_header.pph_amount, (select count(*) from bupot_lines where bupot_header.bupot_id = bupot_lines.bupot_id) as "JumlahKwitansi" from bupot_header,bupot_lines,listing_kwt where bupot_header.bupot_id = bupot_lines.bupot_id and listing_kwt.kwt_id = bupot_lines.kwt_id and bupot_header.customer_id = '. $request->cust_id .' and bupot_date BETWEEN "'.$request->tanggal_awal.'" and "'.$request->tanggal_akhir.'" and bupot_number like "%'.$request->nomor_bupot.'%"');
        return response()->json([
            'data' => $data
        ], 200);
    }
    public function getBupotDetail($id){
        // $kwt =DB::select('select distinct status,bupot_number,bupot_date,bupot_header.dpp_amount,percentage,bupot_header.pph_amount, (select count(*) from bupot_lines) as "JumlahKwitansi" from bupot_header,bupot_lines,listing_kwt where bupot_header.bupot_id = bupot_lines.bupot_id and listing_kwt.kwt_id = bupot_lines.kwt_id and bupot_header.customer_id = 1 and bupot_number='.$id);
        // $kwt = $kwt->values()->toArray();
        $post = DB::table('bupot_header')->where('bupot_id',$id)->first();
        return response([
            'data' => $post
        ], 200);
    }

    public function getListingkwtDetail($id,$custid){
        $kwt = DB::select('select a.kwt_number,a.kwt_date,a.kwt_type,a.dpp_amount,a.ppn_amount,a.pph_amount from listing_kwt as A, bupot_lines as B, bupot_header as C where a.kwt_id = b.kwt_id and c.bupot_id = b.bupot_id and c.customer_id ='. $custid .' and c.bupot_id='.$id);
        return response([
            'data' => $kwt
        ],200);
    }

    public function getListingkwtDetailValidator($id){
        $kwt = DB::select('select a.kwt_number,a.kwt_date,a.kwt_type,a.dpp_amount,a.ppn_amount,a.pph_amount from listing_kwt as A, bupot_lines as B, bupot_header as C where a.kwt_id = b.kwt_id and c.bupot_id = b.bupot_id and c.bupot_id='.$id);
        return response([
            'data' => $kwt
        ],200);
    }

    public function updateStatusBupotSubmit($id){
        $update = 	DB::table('bupot_header')->where('bupot_id',$id)->update([
                        'status' => "S"
                    ]);
        if($update){
            return response('Sukses',200);        
        }else{
            return response('Gagal',400);
        }
    }

    public function updateStatusBupotCancel($id){
        $update = 	DB::table('bupot_header')->where('bupot_id',$id)->update([
                        'status' => "C"
                    ]);
        if($update){
            return response('Sukses',200);        
        }else{
            return response('Gagal',400);
        }
    }

    public function getKwtterdaftar(){
        $kwtTerdaftar = DB::table('bupot_lines')->pluck('kwt_id');
        return response([
            'data' => $kwtTerdaftar
        ],200);
    }

    public function store(Request $request)
    {       
        // print_r($request->role_id);
        $bupot_header = new BupotHeader();
        $bupot_header->store($request->data_bupot,$request->user_id,$request->role_id,$request->customer_id);
        $idBupot=$bupot_header->getIdbupot();

        $data_process=new BupotLines();
        $data_process->store($request->data_process,$request->user_id,$idBupot);
        return response()->json([
            'message' => 'Data Tersimpan!'
        ], 200);
    }
    
    public function getKwtArray($id,$custid){
        $kwt = DB::select('select a.kwt_number,a.kwt_date,a.kwt_type,a.dpp_amount,a.ppn_amount,a.pph_amount from listing_kwt as A, bupot_lines as B, bupot_header as C where a.kwt_id = b.kwt_id and c.bupot_id = b.bupot_id and c.customer_id ='. $custid .' and c.bupot_id='.$id);
        // $kwt = $kwt->pluck('kwt_number');
        return response([
            'data' => $kwt
        ],200);
    }
}
