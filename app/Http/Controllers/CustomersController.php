<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CustomersController extends Controller
{
    public function index()
    {
        $user =DB::table('sys_customers')->get();
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
            'customer_number'     => 'required|unique:sys_customers',
            'customer_name'   => 'required',
            'description' => 'required',
            'email' => 'required',
            'attribute1' => 'required',
            'attribute2' => 'required',
            'attribute3' => 'required',
            'attribute4' => 'required',
            'attribute5' => 'required',
            'active_flag' => 'required'
        ],
            [
                'customer_number.required' => 'Masukkan Customer Number !',
                'customer_name.required' => 'Masukkan Customer Name !',
                'description.required' => 'Masukkan Deskripsi !',
                'email.required' => 'Masukkan Email !',
                'attribute1.required' => 'Masukkan Attribute 1 !',
                'attribute2.required' => 'Masukkan Attribute 2!',
                'attribute3.required' => 'Masukkan Attribute 3!',
                'attribute4.required' => 'Masukkan Attribute 4!',
                'attribute5.required' => 'Masukkan Attribute 5!',
                'active_flag.required' => 'Masukkan Active Flag !',
            ]
        );
        
        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],400);

        } else {

            $User = DB::table('sys_customers')->insert([
                'customer_number'     => $request->input('customer_number'),
                'customer_name'     => $request->input('customer_name'),
                'description'     => $request->input('description'),
                'email'   => $request->input('email'),
                'attribute1' => $request->input('attribute1'),
                'attribute2' => $request->input('attribute2'),
                'attribute3' => $request->input('attribute3'),
                'attribute4' => $request->input('attribute4'),
                'attribute5' => $request->input('attribute5'),
                'active_flag' => $request->input('active_flag'),
                'created_by' => $id,
                'updated_by' => $id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);


            if ($User) {
                return response()->json([
                    'success' => true,
                    'message' => 'Customers Berhasil Disimpan!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Customers Gagal Disimpan!',
                ], 400);
            }
        }
    }

    public function update(Request $request)
    {
        //validate data
        $validator = Validator::make($request->all(), [
            'customer_number'     => 'required|',
            'customer_name'   => 'required',
            'description' => 'required',
            'email' => 'required',
            'attribute1' => 'required',
            'attribute2' => 'required',
            'attribute3' => 'required',
            'attribute4' => 'required',
            'attribute5' => 'required',
            'active_flag' => 'required'
        ],
            [
                'customer_number.required' => 'Masukkan Customer Number !',
                'customer_name.required' => 'Masukkan Customer Name !',
                'description.required' => 'Masukkan Deskripsi !',
                'email.required' => 'Masukkan Email !',
                'attribute1.required' => 'Masukkan Attribute 1 !',
                'attribute2.required' => 'Masukkan Attribute 2!',
                'attribute3.required' => 'Masukkan Attribute 3!',
                'attribute4.required' => 'Masukkan Attribute 4!',
                'attribute5.required' => 'Masukkan Attribute 5!',
                'active_flag.required' => 'Masukkan Active Flag !',
            ]
        );

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],400);

        } else {

            $User = DB::table('sys_customers')->where('id',$request->id)->update([
                'customer_number'     => $request->input('customer_number'),
                'customer_name'     => $request->input('customer_name'),
                'description'     => $request->input('description'),
                'email'   => $request->input('email'),
                'attribute1' => $request->input('attribute1'),
                'attribute2' => $request->input('attribute2'),
                'attribute3' => $request->input('attribute3'),
                'attribute4' => $request->input('attribute4'),
                'attribute5' => $request->input('attribute5'),
                'active_flag' => $request->input('active_flag'),
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
        $post = DB::table('sys_customers')->whereId($id)->first();
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
        $user = DB::table('sys_customers')->where('id',$id)->delete();

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
