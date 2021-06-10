<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrxPageController extends Controller
{
    public function index(){
        $kwt =DB::select('select distinct bupot_header.bupot_id,status,bupot_number,bupot_date,bupot_header.dpp_amount,percentage,bupot_header.pph_amount, (select count(*) from bupot_lines) as "JumlahKwitansi" from bupot_header,bupot_lines,listing_kwt where bupot_header.bupot_id = bupot_lines.bupot_id and listing_kwt.kwt_id = bupot_lines.kwt_id and bupot_header.customer_id = 1');
        // $kwt = $kwt->values()->toArray();
        return response([
            'data' => $kwt
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

    public function getListingkwtDetail($id){
        $kwt = DB::select('select a.kwt_number,a.kwt_date,a.kwt_type,a.dpp_amount,a.ppn_amount,a.pph_amount from listing_kwt as A, bupot_lines as B, bupot_header as C where a.kwt_id = b.kwt_id and c.bupot_id = b.bupot_id and c.customer_id = 1 and c.bupot_id='.$id);
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

    public function store(Request $request, $id)
    {
            $User = DB::table('bupot_header')->insert([
                'bupot_number'     => $request->input('bupot_number'),
                'bupot_date'     => $request->input('bupot_date'),
                'dpp_amount'     => $request->input('dpp_amount'),
                'percentage'   => $request->input('percentage'),
                'pph_amount'     => $request->input('pph_amount')
            ]);


            if ($User) {
                return response()->json([
                    'success' => true,
                    'message' => 'Post Berhasil Disimpan!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Post Gagal Disimpan!',
                ], 400);
            }
    }
    // public function insertTemporary(Request $request){
    //     // $a=$request->input('kwt_id');
    //     // $i=0;
    //     echo'kwt_id';
    //     // // foreach($request as $p){
    //     // //     $i=$i+1;
    //     // //     $a=$a.$p->kwt_id;
    //     // // }
    //     return response($a,200);   
    //     // $User = DB::table('sys_menus')->insert([
    //     //     'menu_name'     => $request->input('menu_name'),
    //     //     'menu_desc'     => $request->input('menu_desc'),
    //     //     'role_id'     => $request->input('role_id'),
    //     //     'seq'     => $request->input('seq'),
    //     //     'active_flag'   => $request->input('active_flag'),
    //     //     'is_detail' => $request->input('is_detail'),
    //     //     'created_by'     => $id,
    //     //     'last_update_by' => $id,
    //     //     'created_at' => date('Y-m-d H:i:s'),
    //     //     'updated_at' => date('Y-m-d H:i:s')
    //     // ]);
    // }
}
