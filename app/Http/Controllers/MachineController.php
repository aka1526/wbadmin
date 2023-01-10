<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

use App\Models\Machine;
use App\Models\Machinegroup;
use App\Models\Uploadfile;

use App\Http\Controllers\uploadFilecontroller;

class MachineController extends Controller
{
    protected $paging = 20;
    protected $doc_type ="machine";
    public function NewUnid()
    {
        $table = 'machine';
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

        $doc_type = $this->doc_type ;
        $dataset = Machine::select('machine.*')
        ->selectRaw('machine_group.group_name')
        ->leftJoin("machine_group", "machine_group.unid", "=", "machine.mc_group")
        ->orderBy('group_name', 'asc')
        ->orderBy('mc_name', 'asc')
        ->paginate($this->paging);
        return view($doc_type.'/index', compact('dataset','doc_type'));
    }


    public function add(Request $request)
    {
        $doc_type=$this->doc_type ;
        $Machinegroup = Machinegroup::orderBy('group_name', 'asc')->get();
        return view($doc_type.'.add',compact('doc_type','Machinegroup'));
    }

    public function save(Request $request)
    {

        $validated = $request->validate([
            'mc_group' => 'required',
            'mc_name' => 'required',

        ], [
            'mc_group.required' => 'กรุณาใส่ข้อมูล',
            'mc_name.required' => 'กรุณาใส่ข้อมูล',
        ]);
        $msg = false;
        $userName = "sysadmin";
        $unid = $this->NewUnid();
        $mc_group = $request->mc_group;
        $mc_name = $request->mc_name;
        $mc_total = isset($request->mc_total) ? $request->mc_total : 0;
        $mc_img = $request->mc_img;


        $doc_type=$this->doc_type ;
        $img_group='logo';
        $create_time = Carbon::now()->format("Y-m-d H:i:s");

        $act = Machine::insert([
            'unid' => $unid,
            'mc_group' => $mc_group,
            'mc_name' => $mc_name,
            'mc_total' => $mc_total,

            'create_by' => $userName,
            'create_time' => $create_time,
            'modify_by' => $userName,
            'modify_time' => $create_time,

        ]);

        if ($act) {
            if ($request->hasFile('mc_img')) {
                $file = $request->file('mc_img');
                // foreach ($files as $file) {
                $uploadFile = new uploadFilecontroller();
                $saveimg = $uploadFile->saveLogo($unid, $doc_type,$img_group, $file);
                if($saveimg!=''){
                    Machine::where('unid','=',$unid)->update(['mc_img' =>$saveimg]);
                }


            }
        }

        return redirect($doc_type)->with('msg', $act);
    }


    function edit(Request $request){
        $unid =$request->unid;
        $Machinegroup = Machinegroup::orderBy('group_name', 'asc')->get();
        $datarow = Machine::where('unid','=',$unid)->first();
        $doc_type="machine";
        return view($doc_type.'.edit' ,compact('datarow','Machinegroup')) ;
    }

    public function update(Request $request)
    {

        $validated = $request->validate([
            'mc_group' => 'required',
            'mc_name' => 'required',

        ], [
            'mc_group.required' => 'กรุณาใส่ข้อมูล',
            'mc_name.required' => 'กรุณาใส่ข้อมูล',
        ]);

        $msg = false;
        $userName = "sysadmin";
        $unid = $request->unid;
        $mc_group = $request->mc_group;
        $mc_name = $request->mc_name;
        $mc_total = isset($request->mc_total) ? $request->mc_total : 0;
        $mc_img = $request->mc_img;


        $doc_type=$this->doc_type ;
        $img_group='logo';

        $create_time = Carbon::now()->format("Y-m-d H:i:s");

        $act = Machine::where('unid','=',$unid)->update([
            'mc_group' => $mc_group,
            'mc_name' => $mc_name,
            'mc_total' => $mc_total,
            'modify_by' => $userName,
            'modify_time' => $create_time,

        ]);

        if ($act) {
            if ($request->hasFile('mc_img')) {
                $file = $request->file('mc_img');
                $uploadFile = new uploadFilecontroller();
                $img_group='logo';
                $saveimg = $uploadFile->saveLogo($unid, $doc_type,$img_group, $file);
                if($saveimg!=''){
                    Machine::where('unid','=',$unid)->update(['mc_img' =>$saveimg]);
                }
            }

        }

        return redirect($doc_type)->with('msg', $act);
    }

    function delete(Request $request){
        $unid =$request->unid;

            $act=  Machine::where('unid','=',$unid)->delete();
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
