<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class MenuDetailController extends Controller
{
    public function index()
    {
        $menu = DB::select('select a.menu_detail_id,a.menu_detail_name,a.menu_detail_desc,a.active_flag,a.seq,a.created_by,a.last_update_by,a.created_at,a.updated_at from sys_menus_details as A, sys_menus AS B where a.menu_detail_id = b.menu_id and b.is_detail = "Y"');
        return response([
            'success' => true,
            'message' => 'List Semua Menu',
            'data' => $menu
        ], 200);
    }

    public function store(Request $request, $id)
    {
        //validate data
        // echo $request->role_id;
        $validator = Validator::make($request->all(), [
            'menu_detail_id'     => 'required',
            'menu_detail_name'     => 'required',
            'menu_detail_desc'     => 'required',
            'active_flag' => 'required',
            'seq' => 'required|unique:sys_menus_details'
        ],
            [
                'menu_detail_name.required' => 'Masukkan Nama Menu !',
                'menu_detail_desc.required' => 'Masukkan Deskripsi Menu !',
                'active_flag.required' => 'Masukkan Role Id !',
                'seq.required' => 'Masukkan Seq !',
            ]
        );
        
        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],400);

        } else {

            $User = DB::table('sys_menus_details')->insert([
                'menu_detail_id'     => $request->input('menu_detail_id'),
                'menu_detail_name'     => $request->input('menu_detail_name'),
                'menu_detail_desc'     => $request->input('menu_detail_desc'),
                'active_flag'   => $request->input('active_flag'),
                'seq'     => $request->input('seq'),
                'created_by' => $id,
                'last_update_by' => $id,
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s')
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
    }

    public function update(Request $request ,$id)
    {
        //validate data
        $validator = Validator::make($request->all(), [
            'menu_detail_name'     => 'required',
            'menu_detail_desc'     => 'required',
            'active_flag' => 'required',
            'seq' => 'required'
        ],
            [
                'menu_detail_name.required' => 'Masukkan Nama Menu Detail!',
                'menu_detail_desc.required' => 'Masukkan Deskripsi Menu Detail!',
                'active_flag.required' => 'Masukkan Role Id !',
                'seq.required' => 'Masukkan Seq !',
            ]
        );

        if($validator->fails()) {
            
            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],400);
            
        } else {
            
            $User = DB::table('sys_menus_details')->where('menu_detail_id',$request->id)->update([
                'menu_detail_id'     => $request->input('menu_detail_id'),
                'menu_detail_name'     => $request->input('menu_detail_name'),
                'menu_detail_desc'     => $request->input('menu_detail_desc'),
                'active_flag'   => $request->input('active_flag'),
                'seq'     => $request->input('seq'),
                'last_update_by' => $id,
                'updated_at' => date('Y-m-d H:i:s')
                ]);
                
                if ($User) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Post Berhasil Diupdate!',
                    ], 200);
                } else {
                    return response()->json([
                    'success' => false,
                    'message' => 'Post Gagal Diupdate!',
                ], 500);
            }

        }

    }

    public function show($id)
    {
        $post = DB::table('sys_menus_details')->where('menu_detail_id',$id)->first();
        if ($post) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Post!',
                'data'    => $post
            ], 200);
        } else {
            echo "Masok";
            return response()->json([
                'success' => false,
                'message' => 'Post Tidak Ditemukan!',
                'data'    => ''
            ], 404);
        }
    }

    public function destroy($id)
    {
        $user = DB::table('sys_menus_details')->where('menu_detail_id',$id)->delete();

        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'Post Berhasil Dihapus!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post Gagal Dihapus!',
            ], 500);
        }

    }
}
