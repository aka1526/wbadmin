<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\Models\Partners;
use App\Models\Uploadfile;

use App\Http\Controllers\uploadFilecontroller;

class PartnersController extends Controller
{
    protected $paging = 20;

    public function NewUnid()
    {
        $table = 'partners';
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

        $doc_type = "partners";
        $dataset = Partners::orderBy('partners_name', 'asc')->paginate($this->paging);
        return view($doc_type.'/index', compact('dataset','doc_type'));
    }


    public function add(Request $request)
    {
        $doc_type='partners';

        return view($doc_type.'.add',compact('doc_type'));
    }

    public function save(Request $request)
    {

        $validated = $request->validate([
            'partners_name' => 'required',

        ], [
            'partners_name.required' => 'กรุณาใส่ข้อมูล',
        ]);
        $msg = false;
        $userName = "sysadmin";
        $unid = $this->NewUnid();
        $partners_name = $request->partners_name;
        $partners_logo = $request->partners_logo;
        $partners_url = $request->partners_url;
        $partners_status = "Y";
        $doc_type='partners';
        $img_group='logo';
        $create_time = Carbon::now()->format("Y-m-d H:i:s");

        $act = Partners::insert([
            'unid' => $unid,
            'partners_name' => $partners_name,
            'partners_url' => $partners_url,
            'partners_status' => $partners_status,
            'create_by' => $userName,
            'create_time' => $create_time,
            'modify_by' => $userName,
            'modify_time' => $create_time,

        ]);

        if ($act) {
            if ($request->hasFile('partners_logo')) {
                $file = $request->file('partners_logo');
                // foreach ($files as $file) {
                $uploadFile = new uploadFilecontroller();
                $saveimg = $uploadFile->saveLogo($unid, $doc_type,$img_group, $file);
                if($saveimg!=''){
                    Partners::where('unid','=',$unid)->update(['partners_logo' =>$saveimg]);
                }


            }
        }

        return redirect($doc_type)->with('msg', $act);
    }


    function edit(Request $request){
        $unid =$request->unid;
        $datarow = Partners::where('unid','=',$unid)->first();
        $doc_type="Partners";
        return view($doc_type.'.edit' ,compact('datarow')) ;
    }

    public function update(Request $request)
    {

        $validated = $request->validate([
            'partners_name' => 'required',

        ], [
            'partners_name.required' => 'กรุณาใส่ข้อมูล',
        ]);
        $msg = false;
        $userName = "sysadmin";
        $unid = $request->unid;
        $partners_name = $request->partners_name;
        $partners_logo = $request->partners_logo;
        $partners_url = $request->partners_url;
        $partners_status = $request->partners_status;
        $doc_type='partners';
        $img_group='logo';
        $create_time = Carbon::now()->format("Y-m-d H:i:s");

        $act = Partners::where('unid','=',$unid)->update([
            'partners_name' => $partners_name,
            'partners_url' => $partners_url,
            'partners_status' => $partners_status,
            'modify_by' => $userName,
            'modify_time' => $create_time,

        ]);

        if ($act) {
            if ($request->hasFile('partners_logo')) {
                $file = $request->file('partners_logo');
                // foreach ($files as $file) {
                $uploadFile = new uploadFilecontroller();
                $saveimg = $uploadFile->saveLogo($unid, $doc_type,$img_group, $file);
                if($saveimg!=''){
                    Partners::where('unid','=',$unid)->update(['partners_logo' =>$saveimg]);
                }


            }
        }

        return redirect($doc_type)->with('msg', $act);
    }

    function delete(Request $request){
        $unid =$request->unid;

            $act=  Partners::where('unid','=',$unid)->delete();
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
