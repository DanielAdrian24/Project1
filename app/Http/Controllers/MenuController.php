<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function index()
    {
        $menu = DB::table('sys_menus')->get();
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
            'menu_name'     => 'required',
            'menu_desc'     => 'required',
            'role_id'   => 'required',
            'seq' => 'required',
            'active_flag' => 'required',
            'is_detail' => 'required'
        ],
            [
                'menu_name.required' => 'Masukkan Nama Menu !',
                'menu_desc.required' => 'Masukkan Deskripsi Menu !',
                'role_id.required' => 'Masukkan Role Id !',
                'seq.required' => 'Masukkan Seq !',
                'active_flag.required' => 'Masukkan Active Flag !',
                'is_detail.required' => 'Masukkan is_detail !',
            ]
        );
        
        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],400);

        } else {

            $User = DB::table('sys_menus')->insert([
                'menu_name'     => $request->input('menu_name'),
                'menu_desc'     => $request->input('menu_desc'),
                'role_id'     => $request->input('role_id'),
                'seq'     => $request->input('seq'),
                'active_flag'   => $request->input('active_flag'),
                'is_detail' => $request->input('is_detail'),
                'created_by'     => $id,
                'last_update_by' => $id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
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
            'menu_name'     => 'required',
            'menu_desc'     => 'required',
            'role_id'   => 'required',
            'seq' => 'required',
            'active_flag' => 'required',
            'is_detail' => 'required'
        ],
            [
                'menu_name.required' => 'Masukkan Nama Menu !',
                'menu_desc.required' => 'Masukkan Deskripsi Menu !',
                'role_id.required' => 'Masukkan Role Id !',
                'seq.required' => 'Masukkan Seq !',
                'active_flag.required' => 'Masukkan Active Flag !',
                'is_detail.required' => 'Masukkan is_detail !',
            ]
        );

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],400);

        } else {

            $User = DB::table('sys_menus')->where('menu_id',$request->id)->update([
                'menu_name'     => $request->input('menu_name'),
                'menu_desc'     => $request->input('menu_desc'),
                'role_id'     => $request->input('role_id'),
                'seq'     => $request->input('seq'),
                'active_flag'   => $request->input('active_flag'),
                'is_detail' => $request->input('is_detail'),
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
        $post = DB::table('sys_menus')->where('menu_id',$id)->first();
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
        $user = DB::table('sys_menus')->where('menu_id',$id)->delete();

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
