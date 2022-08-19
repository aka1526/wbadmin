<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\Models\News;
use App\Models\Uploadfile;

use App\Http\Controllers\uploadFilecontroller;

class CustomersController extends Controller
{
    protected $paging = 20;

    public function NewUnid()
    {
        $table = 'news';
        $number = date("ymdhis", time());
        $length = 7;

        do {
            for ($i = $length; $i--; $i > 0) {
                $number .= mt_rand(0, 9);
            }
        } while (!empty(DB::table($table)->where('unid', $number)->first(['unid'])));

        return $number;
    }
    public function add(Request $request)
    {
        $doc_type='customers';

        return view($doc_type.'.add',compact('doc_type'));
    }


}
