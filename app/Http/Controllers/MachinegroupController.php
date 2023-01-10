<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\Models\Machinegroup;
use App\Models\Uploadfile;

use App\Http\Controllers\uploadFilecontroller;

class MachinegroupController extends Controller
{
    protected $paging = 20;

    protected $doc_type = "machine/group";

    public function NewUnid()
    {
        $table = 'machine_group';
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
        $doc_type=$this->doc_type;
        $dataset = Machinegroup::orderBy('group_name', 'asc')->paginate($this->paging);
        return view('machine_group.index', compact('dataset','doc_type'));
    }


    public function add(Request $request)
    {
        $doc_type=$this->doc_type;
        return view('machine_group/add',compact('doc_type'));
    }

    public function save(Request $request)
    {

        $validated = $request->validate([
            'group_name' => 'required',

        ], [
            'group_name.required' => 'กรุณาใส่ข้อมูล',
        ]);
        $msg = false;
        $userName = "sysadmin";
        $unid = $this->NewUnid();
        $group_name = $request->group_name;

        $doc_type=$this->doc_type;

        $create_time = Carbon::now()->format("Y-m-d H:i:s");

        $act = Machinegroup::insert([
            'unid' => $unid,
            'group_name' => $group_name,

            'create_by' => $userName,
            'create_time' => $create_time,
            'modify_by' => $userName,
            'modify_time' => $create_time,

        ]);


        return redirect($doc_type)->with('msg', $act);
    }


    function edit(Request $request){
        $unid =$request->unid;

        $datarow = Machinegroup::where('unid','=',$unid)->first();
        $doc_type=$this->doc_type;
        return view('/machine_group/edit' ,compact('datarow')) ;
    }

    public function update(Request $request)
    {

        $validated = $request->validate([
            'group_name' => 'required',

        ], [
            'group_name.required' => 'กรุณาใส่ข้อมูล',
        ]);
        $msg = false;
        $userName = "sysadmin";
        $unid = $request->unid;
        $group_name = $request->group_name;

        $doc_type=$this->doc_type;

        $create_time = Carbon::now()->format("Y-m-d H:i:s");
        $act=false;
        $act = Machinegroup::where('unid','=',$unid)->update([
            'group_name' => $group_name,

            'modify_by' => $userName,
            'modify_time' => $create_time,

        ]);


        return redirect($doc_type)->with('msg', $act);
    }

    function delete(Request $request){
        $unid =$request->unid;

            $act=  Machinegroup::where('unid','=',$unid)->delete();
            if($act){
                $msg="ลบสำเสร็จ";
                $result="success";
            } else {
                $msg="เกิดข้อผิดพลาด";
                $result="error";
            }

            return response()->json(['result'=> $result,'msg'=> $msg],200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);

    }

}
