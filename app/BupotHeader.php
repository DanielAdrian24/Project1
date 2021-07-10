<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BupotHeader extends Model
{
    public function getIdbupot(){
        $data=DB::table('bupot_header')->latest('bupot_id')->pluck('bupot_id')->first();
        return intval($data);
    }
    public function store($data,$user_id,$role_id,$customer_id){
        print_r($data);
            $insert=DB::table('bupot_header')->insert([
                'bupot_number' => $data['bupot_number'],
                'status' => 'D',
                'bupot_date' => $data['bupot_date'],
                'dpp_amount' => $data['dpp_amount'],
                'percentage' => $data['percentage'],
                'pph_amount' => $data['pph_amount'],
                'user_id' => $user_id,
                'customer_id' =>$customer_id,
                'creation_date' => date('Y-m-d'),
                'last_updated_by' => $user_id,
                'last_update_Date' => date('Y-m-d')
            ]);
        return 1;
    }
}
