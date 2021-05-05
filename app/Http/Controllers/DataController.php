<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    public function index()
    {
        $user = user::where('id', '!=' , 1)->get();
        return response([
            'success' => true,
            'message' => 'List Semua User',
            'data' => $user
        ], 200);
    }

    public function store(Request $request, $id)
    {
        //validate data
        // echo $request->password;
        $validator = Validator::make($request->all(), [
            'username'     => 'required|unique:users',
            'customer_id'   => 'required',
            'email' => 'required',
            'active_flag' => 'required',
            'role_id' => 'required',
            'password' => 'required'
        ],
            [
                'username.required' => 'Masukkan Username !',
                'customer_id.required' => 'Masukkan Customer Id !',
                'email.required' => 'Masukkan Email !',
                'active_flag.required' => 'Masukkan Active Flag !',
                'role_id.required' => 'Masukkan Role ID !',
                'password.required' => 'Masukkan password !',
            ]
        );
        
        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],400);

        } else {

            $User = DB::table('users')->insert([
                'username'     => $request->input('username'),
                'password'     => bcrypt($request->password),
                'email'     => $request->input('email'),
                'customer_id'   => $request->input('customer_id'),
                'role_id' => $request->input('role_id'),
                'active_flag'     => $request->input('active_flag'),
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

    public function update(Request $request)
    {
        //validate data
        $validator = Validator::make($request->all(), [
            'username'     => 'required',
            'customer_id'   => 'required',
            'email' => 'required',
            'active_flag' => 'required',
            'role_id' => 'required',
            'password' => 'required'
        ],
            [
                'username.required' => 'Masukkan Username !',
                'password.required' => 'Masukkan password !',
                'customer_id.required' => 'Masukkan Customer Id !',
                'email.required' => 'Masukkan Email !',
                'active_flag.required' => 'Masukkan Active Flag !',
                'role_id.required' => 'Masukkan Role ID !',
            ]
        );

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],400);

        } else {

            $User = DB::table('users')->where('id',$request->id)->update([
                'username'     => $request->input('username'),
                'password'     => bcrypt($request->password),
                'email'     => $request->input('email'),
                'customer_id'   => $request->input('customer_id'),
                'role_id' => $request->input('role_id'),
                'active_flag'     => $request->input('active_flag'),
                'last_update_by' => $request->input('customer_id'),
                'updated_at' => date('Y-m-d H:i:s'),
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
        $post = User::whereId($id)->first();

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

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

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
