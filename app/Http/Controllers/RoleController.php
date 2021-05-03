<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function indexroles()
    {
        $roles = DB::table('sys_roles')->get();
        return response([
            'success' => true,
            'message' => 'List Semua User',
            'data' => $roles
        ], 200);
    }

    public function storerole(Request $request)
    {
        //validate data
        // echo $request->password;
        echo "masok";
        $validator = Validator::make($request->all(), [
            'role_name'     => 'required|unique:sys_roles',
            'role_desc'   => 'required'
        ],
            [
                'role_name.required' => 'Masukkan Role Name !',
                'role_desc.required' => 'Masukkan Role Desc !',
            ]
        );
        
        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],400);

        } else {

            $role = DB::table('sys_roles')->insert([
                'role_name'     => $request->input('role_name'),
                'role_desc'     => $request->input('role_desc')
            ]);


            if ($role) {
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
    
    public function updaterole(Request $request)
    {
        //validate data
        // echo "masok";
        $validator = Validator::make($request->all(), [
            'role_name'     => 'required|unique:sys_roles',
            'role_desc'   => 'required'
        ],
            [
                'role_name.required' => 'Masukkan Role Name !',
                'role_desc.required' => 'Masukkan Role Desc !',
            ]
        );

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],400);

        } else {

            $User = DB::table('sys_roles')->where('id',$request->id)->update([
                'role_name'     => $request->input('role_name'),
                'role_desc'     => $request->input('role_desc'),
            ]);

            if ($User) {
                return response()->json([
                    'success' => true,
                    'message' => 'Role Berhasil Diupdate!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Role Gagal Diupdate!',
                ], 500);
            }

        }

    }

    public function showrole($id)
    {
        $post = DB::table('sys_roles')->whereId($id)->first();

        if ($post) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Post!',
                'data'    => $post
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post Tidak Ditemukan!',
                'data'    => ''
            ], 404);
        }
    }

    
    public function destroyrole($id)
    {
        $user = DB::table('sys_roles')->where('id',$id)->delete();

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
