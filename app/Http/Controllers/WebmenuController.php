<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

use App\Models\Webmenu;
use App\Models\Websubmenu;

class WebmenuController extends Controller
{
    protected $paging = 20;

    public function NewUnid()
    {
        $table = 'webmenu';
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

        $doc_type = "webmenu";
        $dataset = Webmenu::orderBy('modify_time', 'desc')->paginate($this->paging);
        return view($doc_type.'/index', compact('dataset','doc_type'));
    }


    public function add(Request $request)
    {
        $doc_type='webmenu';

        return view($doc_type.'.add',compact('doc_type'));
    }


}
