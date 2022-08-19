<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\Models\News;
use App\Models\Customerlist;


use App\Models\Uploadfile;

use App\Http\Controllers\uploadFilecontroller;

class CustomersController extends Controller
{
    protected $paging = 20;

    public function NewUnid()
    {
        $table = 'customerlist';
        $number = date("ymdhis", time());
        $length = 7;

        do {
            for ($i = $length; $i--; $i > 0) {
                $number .= mt_rand(0, 9);
            }
        } while (!empty(DB::table($table)->where('unid', $number)->first(['unid'])));

        return $number;
    }

    public function index(Request $request)
    {
        $doc_type='customers';
        $datarow=Customerlist::where('unid','!=','')->first();
        if($datarow){
            return view($doc_type.'.edit',compact('doc_type','datarow'));
        } else {
            return view($doc_type.'.add',compact('doc_type'));
        }

    }



    // public function add(Request $request)
    // {
    //     $doc_type='customers';
    //     $datarow=Customerlist::where('unid','!=','')->first();

    //     if($datarow){

    //         return view($doc_type.'.edit',compact('doc_type','datarow'));
    //     } else {
    //         return view($doc_type.'.add',compact('doc_type'));
    //     }

    // }


    public function edit(Request $request)
    {
        $doc_type='customers';

        return view($doc_type.'.add',compact('doc_type'));
    }

    public function save(Request $request)
    {
       // dd('save');
        $validated = $request->validate([
            'cus_list' => 'required',

        ], [
            'cus_list.required' => 'กรุณาใส่ข้อมูล',
        ]);

        $doc_type='customers';
        $msg = false;
        $userName = "sysadmin";
        $unid = $this->NewUnid();
        $cus_list = $request->cus_list;
        $create_time = Carbon::now()->format("Y-m-d H:i:s");


        $act = Customerlist::insert([

            'unid' => $unid,
            'cus_list' => $cus_list,
            'create_by' => $userName,
            'create_time' => $create_time,
            'modify_by' => $userName,
            'modify_time' => $create_time,

        ]);

        return redirect($doc_type)->with('msg', $act);
    }


    public function update(Request $request)
    {
       // dd('save');
        $validated = $request->validate([
            'cus_list' => 'required',

        ], [
            'cus_list.required' => 'กรุณาใส่ข้อมูล',
        ]);

        $doc_type='customers';
        $msg = false;
        $userName = "sysadmin";

        $unid = $request->unid;
        $cus_list = $request->cus_list;
        $create_time = Carbon::now()->format("Y-m-d H:i:s");
        $act = Customerlist::where('unid','=',$unid)->update([
            'cus_list' => $cus_list,
            'modify_by' => $userName,
            'modify_time' => $create_time,

        ]);

        return redirect($doc_type)->with('msg', $act);
    }

}
