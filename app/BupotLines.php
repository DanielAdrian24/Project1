<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BupotLines extends Model
{
    public function store($data,$user_id,$bupot_id){
        foreach($data as $p){
            $insert=DB::table('bupot_lines')->insert([
                'bupot_id' =>$bupot_id,
                'kwt_id'     => $p['kwt_id'],
                'bupot_line_id' => 0,
                'created_by' => $user_id,
                'creation_date' => date('Y-m-d'),
                'last_update_date' => date('Y-m-d')
            ]);
        }
        return 1;
    }
}
