<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

use App\Models\Customer;

use App\Models\Uploadfile;

use App\Http\Controllers\uploadFilecontroller;

class CustomerController extends Controller
{
    protected $paging = 20;
    protected $doc_type ="customer";
    public function NewUnid()
    {
        $table = 'customer';
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
        $dataset = Customer::where('customer_status','!=','')
        ->orderBy('customer_group', 'asc')
        ->orderBy('customer_name', 'asc')
        ->paginate($this->paging);
        return view($doc_type.'/index', compact('dataset','doc_type'));
    }


    public function add(Request $request)
    {
        $doc_type=$this->doc_type ;

        return view($doc_type.'.add',compact('doc_type'));
    }

    public function save(Request $request)
    {

        $validated = $request->validate([
            'customer_name' => 'required',
            'customer_logo' => 'required',

        ], [
            'customer_name.required' => 'กรุณาใส่ข้อมูล',
            'customer_logo.required' => 'กรุณาใส่ข้อมูล',
        ]);
        $msg = false;
        $userName = "sysadmin";
        $unid = $this->NewUnid();

        $customer_name = $request->customer_name;
        $customer_url = $request->customer_url;
        $customer_logo = $request->customer_logo;
        $customer_status="Y";

        $doc_type=$this->doc_type ;
        $img_group='logo';
        $create_time = Carbon::now()->format("Y-m-d H:i:s");

        $act = Customer::insert([
            'unid' => $unid,
            'customer_name' => $customer_name,
            'customer_url' => $customer_url,
            'customer_status' => $customer_status,

            'create_by' => $userName,
            'create_time' => $create_time,
            'modify_by' => $userName,
            'modify_time' => $create_time,

        ]);

        if ($act) {
            if ($request->hasFile('customer_logo')) {
                $file = $request->file('customer_logo');
                // foreach ($files as $file) {
                $uploadFile = new uploadFilecontroller();
                $saveimg = $uploadFile->saveLogo($unid, $doc_type,$img_group, $file);
                if($saveimg!=''){
                    Customer::where('unid','=',$unid)->update(['customer_logo' =>$saveimg]);
                }


            }
        }

        return redirect($doc_type)->with('msg', $act);
    }


    function edit(Request $request){
        $unid =$request->unid;

        $datarow = Customer::where('unid','=',$unid)->first();
        $doc_type=$this->doc_type ;
        return view($doc_type.'.edit' ,compact('datarow')) ;
    }

    public function update(Request $request)
    {

        $validated = $request->validate([
            'customer_name' => 'required',


        ], [
            'customer_name.required' => 'กรุณาใส่ข้อมูล',

        ]);

        $msg = false;
        $userName = "sysadmin";
        $unid = $request->unid;

        $customer_name = $request->customer_name;
        $customer_url = $request->customer_url;
        $customer_logo = $request->customer_logo;
        $customer_status=isset( $request->customer_status) ?  $request->customer_status : 'Y';

        $doc_type=$this->doc_type ;
        $img_group='logo';

        $create_time = Carbon::now()->format("Y-m-d H:i:s");

        $act = Customer::where('unid','=',$unid)->update([
            'customer_name' => $customer_name,
            'customer_url' => $customer_url,
            'customer_status' => $customer_status,

            'modify_by' => $userName,
            'modify_time' => $create_time,

        ]);

        if ($act) {
            if ($request->hasFile('customer_logo')) {
                $file = $request->file('customer_logo');
                $uploadFile = new uploadFilecontroller();
                $img_group='logo';
                $saveimg = $uploadFile->saveLogo($unid, $doc_type,$img_group, $file);
                if($saveimg!=''){
                    Customer::where('unid','=',$unid)->update(['customer_logo' =>$saveimg]);
                }
            }

        }

        return redirect($doc_type)->with('msg', $act);
    }

    function delete(Request $request){
        $unid =$request->unid;

            $act=  Customer::where('unid','=',$unid)->delete();
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
