<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\Models\Slidesimg;

use App\Models\Uploadfile;
use App\Http\Controllers\uploadFilecontroller;

class SlidesimgController extends Controller
{
    protected $paging = 20;

    public function NewUnid()
    {
        $table = 'slidesimg';
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

        $doc_type = "slides";
        $dataset = Slidesimg::orderBy('modify_time', 'desc')->paginate($this->paging);
        return view($doc_type.'/index', compact('dataset','doc_type'));
    }


    public function add(Request $request)
    {
        $doc_type='slides';

        return view($doc_type.'.add',compact('doc_type'));
    }

    public function save(Request $request)
    {

        $validated = $request->validate([
            'slidesimg_img' => 'required',

        ], [
            'slidesimg_img.required' => 'กรุณาใส่ข้อมูล',
        ]);
        $msg = false;
        $userName = "sysadmin";
        $unid = $this->NewUnid();
        $slidesimg_desc = $request->slidesimg_desc;
        $slidesimg_img = $request->slidesimg_img;

        $slidesimg_status = "Y";
        $doc_type='slides';
        $img_group='slide';
        $create_time = Carbon::now()->format("Y-m-d H:i:s");

        $act = Slidesimg::insert([
            'unid' => $unid,
            'slidesimg_desc' => $slidesimg_desc,
            'slidesimg_status' => $slidesimg_status,
            'create_by' => $userName,
            'create_time' => $create_time,
            'modify_by' => $userName,
            'modify_time' => $create_time,

        ]);

        if ($act) {
            if ($request->hasFile('slidesimg_img')) {
                $file = $request->file('slidesimg_img');
                // foreach ($files as $file) {
                $uploadFile = new uploadFilecontroller();
                $saveimg = $uploadFile->saveSlides($unid, $doc_type,$img_group, $file);
                if($saveimg!=''){
                    Slidesimg::where('unid','=',$unid)->update(['slidesimg_img' =>$saveimg]);
                }


            }
        }

        return redirect($doc_type)->with('msg', $act);
    }


    function edit(Request $request){
        $unid =$request->unid;
        $datarow = Slidesimg::where('unid','=',$unid)->first();
        $doc_type="slides";
        return view($doc_type.'.edit' ,compact('datarow','doc_type')) ;
    }

    public function update(Request $request)
    {

        $validated = $request->validate([
            'slidesimg_img' => 'required',

        ], [
            'slidesimg_img.required' => 'กรุณาใส่ข้อมูล',
        ]);
        $msg = false;
        $userName = "sysadmin";
        $unid = $request->unid;
        $slidesimg_desc = $request->slidesimg_desc;
        $slidesimg_img = $request->slidesimg_img;
        $slidesimg_status = $request->slidesimg_status;

        $doc_type='slides';
        $img_group='slide';
        $create_time = Carbon::now()->format("Y-m-d H:i:s");

        $act = Slidesimg::where('unid','=',$unid)->update([

            'slidesimg_desc' => $slidesimg_desc,
            'slidesimg_status' => $slidesimg_status,
            'modify_by' => $userName,
            'modify_time' => $create_time,

        ]);

        if ($act) {
            if ($request->hasFile('slidesimg_img')) {
                $file = $request->file('slidesimg_img');
                // foreach ($files as $file) {
                $uploadFile = new uploadFilecontroller();
                $saveimg = $uploadFile->saveSlides($unid, $doc_type,$img_group, $file);
                if($saveimg!=''){
                    Slidesimg::where('unid','=',$unid)->update(['slidesimg_img' =>$saveimg]);
                }


            }
        }

        return redirect($doc_type)->with('msg', $act);
    }

    function delete(Request $request){
        $unid =$request->unid;

            $act=  Slidesimg::where('unid','=',$unid)->delete();
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
