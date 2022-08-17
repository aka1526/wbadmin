<?php

namespace App\Http\Controllers;

use App\Http\Controllers\uploadFilecontroller;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use App\Models\News;
use App\Models\Uploadfile;
use File;
use Storage;

class NewsController extends Controller
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

    public function index(Request $request)
    {

        $doc_type = str_replace('/','',$request->getPathInfo());
        $doc_type = $doc_type =="" ? "/news" : $doc_type;

        $dataset = News::where('doc_type','=',$doc_type)->orderBy('new_date', 'asc')->paginate($this->paging);
        return view($doc_type.'/index', compact('dataset','doc_type'));
    }

    public function add(Request $request)
    {
        $doc_type='news';
        return view($doc_type.'.add',compact('doc_type'));
    }

    public function save(Request $request)
    {
       // dd('save');
        $validated = $request->validate([
            'new_th_title' => 'required',

        ], [
            'new_th_title.required' => 'กรุณาใส่ข้อมูล',
        ]);
        $msg = false;
        $userName = "sysadmin";
        $unid = $this->NewUnid();

        $new_date = $request->new_date;
        $new_th_title = $request->new_th_title;
        $new_th_detail = $request->new_th_detail;
        $new_status = "Y";
        $img_thumb = "";
        $doc_type =  $request->doc_type;
        $img_group="title";
        $new_en_title = $request->new_en_title;
        $new_en_detail = $request->new_en_detail;
        $create_time = Carbon::now()->format("Y-m-d H:i:s");


        try {
            $new_th_detail =  $request->new_th_detail;
            $dom = new \DomDocument('1.0', 'UTF-8');

          //  $dom->substituteEntities = false;
            $dom->loadHTML(mb_convert_encoding($new_th_detail, 'HTML-ENTITIES', 'utf-8'));

            $imageFile = $dom->getElementsByTagName('img');

            foreach($imageFile as $item => $image){
                $data = $image->getAttribute('src');
                list($type, $data) = explode(';', $data);
                list(, $img_base64) = explode(',', $data);


                $image_name= "/upload/" .$doc_type .'/'.$unid ;
                $image_src= "/upload/" .$doc_type .'/'.$unid ;
                $path = public_path() . $image_name;

                if(!File::isDirectory($path)){

                    File::makeDirectory($path, 0775, true, true);

                }


                $ext= $this->getextension($type);
                $image_name=  $path."/".time().$item.$ext;
                $image_src= $image_src."/".time().$item.$ext;
                $imgeData = base64_decode($img_base64);
               // file_put_contents($image_name, base64_decode($img_base64));
            //

                file_put_contents($image_name, $imgeData);


                $image->removeAttribute('src');
                $image->setAttribute('src', $image_src);
             }

            $new_th_detail =  $dom->saveHTML( $dom->documentElement);

          } catch (\Exception $e) {


          }




          try {
            $new_en_detail =  $request->new_en_detail;
            $dom = new \DomDocument('1.0', 'UTF-8');

          //  $dom->substituteEntities = false;
            $dom->loadHTML(mb_convert_encoding($new_en_detail, 'HTML-ENTITIES', 'utf-8'));

            $imageFile = $dom->getElementsByTagName('img');

            foreach($imageFile as $item => $image){
                $data = $image->getAttribute('src');
                list($type, $data) = explode(';', $data);
                list(, $img_base64) = explode(',', $data);


                $image_name= "/upload/" .$doc_type .'/'.$unid ;
                $image_src= "/upload/" .$doc_type .'/'.$unid ;
                $path = public_path() . $image_name;

                if(!File::isDirectory($path)){

                    File::makeDirectory($path, 0775, true, true);

                }


                $ext= $this->getextension($type);
                $image_name=  $path."/".time().$item.$ext;
                $image_src= $image_src."/".time().$item.$ext;
                $imgeData = base64_decode($img_base64);

                file_put_contents($image_name, $imgeData);
              // dd($image_name);
                $image->removeAttribute('src');
                $image->setAttribute('src', $image_src);
             }

            $new_en_detail =  $dom->saveHTML( $dom->documentElement);

          } catch (\Exception $e) {


          }

        $act = News::insert([

            'unid' => $unid,
            'doc_type' => $doc_type,
            'new_date' => $new_date,
            'img_thumb' => $img_thumb,
            'new_th_title' => $new_th_title,
            'new_th_detail' => $new_th_detail,
            'new_en_title' => $new_en_title,
            'new_en_detail' => $new_en_detail,
            'new_status' => $new_status,
            'create_by' => $userName,
            'create_time' => $create_time,
            'modify_by' => $userName,
            'modify_time' => $create_time,

        ]);

        if ($act) {
            if ($request->hasFile('img_thumb')) {
                $file = $request->file('img_thumb');
                // foreach ($files as $file) {
                $uploadFile = new uploadFilecontroller();
                $saveimg = $uploadFile->saveFile($unid, $doc_type,$img_group, $file);
                if($saveimg!=''){
                    News::where('unid','=',$unid)->update(['img_thumb' =>$saveimg]);
                }


            }
        }

        return redirect($doc_type)->with('msg', $act);
    }


    function edit(Request $request){
        $unid =$request->unid;
        $datarow = News::where('unid','=',$unid)->first();
        $doc_type=$datarow->doc_type;
        return view($doc_type.'.edit' ,compact('datarow'));
    }

    function getextension( $extension){
        $ext=".jpg";
        if( $extension=='data:image/jpeg'){
            $ext=".jpg";
        }else  if( $extension=='data:image/png'){
            $ext=".png";
        }else  if( $extension=='data:image/gif'){
            $ext=".gif";
        }else  if( $extension=='data:image/bmp'){
            $ext=".bmp";
        }
        return $ext ;
    }
    function update(Request $request){

        $validated = $request->validate([
            'unid' => 'required',

        ],[
            'unid.required' => 'กรุณาใส่ข้อมูล',
        ]);

        $act = false;
        $userName = "sysadmin2";
        $unid =$request->unid;
        $new_date = $request->new_date;
        $new_th_title = $request->new_th_title;
        $new_th_detail = $request->new_th_detail;
        $new_status = $request->new_status;

        $doc_type =  $request->doc_type;
        $img_group="title";
        $new_en_title = $request->new_en_title;
        $new_en_detail = $request->new_en_detail;
        $create_time = Carbon::now()->format("Y-m-d H:i:s");

        $new_th_detail = $request->new_th_detail;

        // try {
        //     $new_th_detail =  $request->new_th_detail;
        //     $dom = new \DomDocument('1.0', 'UTF-8');

        //   //  $dom->substituteEntities = false;
        //     $dom->loadHTML(mb_convert_encoding($new_th_detail, 'HTML-ENTITIES', 'utf-8'));

        //     $imageFile = $dom->getElementsByTagName('img');

        //     foreach($imageFile as $item => $image){
        //         $data = $image->getAttribute('src');
        //         list($type, $data) = explode(';', $data);
        //         list($ext, $data)      = explode(',', $data);

        //         $ext= $this->getextension($type);
        //         $imgeData = base64_decode($data);
        //         $image_name= "/upload/" .$doc_type .'/'.$unid ;
        //         $path = public_path() . $image_name;

        //         if(!File::isDirectory($path)){

        //             File::makeDirectory($path, 0777, true, true);

        //         }

        //         file_put_contents($path, $imgeData);
        //         $image_name= "/upload/" .$doc_type .'/'.$unid.'/'. time().$item.$ext;
        //         $image->removeAttribute('src');
        //         $image->setAttribute('src', $image_name);
        //      }

        //     $new_th_detail =  $dom->saveHTML( $dom->documentElement);

        //   } catch (\Exception $e) {


        //   }

        //   try {
        //     $new_en_detail =  $request->new_en_detail;
        //     $dom = new \DomDocument('1.0', 'UTF-8');

        //   //  $dom->substituteEntities = false;
        //     $dom->loadHTML(mb_convert_encoding($new_en_detail, 'HTML-ENTITIES', 'utf-8'));

        //     $imageFile = $dom->getElementsByTagName('img');

        //     foreach($imageFile as $item => $image){
        //         $data = $image->getAttribute('src');
        //         list($type, $data) = explode(';', $data);
        //         list(, $data)      = explode(',', $data);
        //         $ext= $this->getextension($type);
        //         $imgeData = base64_decode($data);
        //         $image_name= "/upload/" .$doc_type .'/'.$unid;
        //         $path = public_path() . $image_name;
        //         if(!File::isDirectory($path)){

        //             File::makeDirectory($path, 0777, true, true);

        //         }
        //         $image_name= "/upload/" .$doc_type .'/'.$unid.'/'. time().$item.$ext;
        //         file_put_contents($path, $imgeData);

        //         $image->removeAttribute('src');
        //         $image->setAttribute('src', $image_name);
        //      }

        //     //  $doc = new DOMDocument('1.0', 'UTF-8');
        //     //  $doc->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
        //     //  print $doc->saveHTML($doc->documentElement) . PHP_EOL . PHP_EOL;

        //     $new_en_detail =  $dom->saveHTML( $dom->documentElement);

        //   } catch (\Exception $e) {


        //   }

      //  dd($content );


      try {
        $new_th_detail =  $request->new_th_detail;
        $dom = new \DomDocument('1.0', 'UTF-8');

      //  $dom->substituteEntities = false;
        $dom->loadHTML(mb_convert_encoding($new_th_detail, 'HTML-ENTITIES', 'utf-8'));

        $imageFile = $dom->getElementsByTagName('img');

        foreach($imageFile as $item => $image){
            $data = $image->getAttribute('src');
            list($type, $data) = explode(';', $data);
            list(, $img_base64) = explode(',', $data);


            $image_name= "/upload/" .$doc_type .'/'.$unid ;
            $image_src= "/upload/" .$doc_type .'/'.$unid ;
            $path = public_path() . $image_name;

            if(!File::isDirectory($path)){

                File::makeDirectory($path, 0775, true, true);

            }


            $ext= $this->getextension($type);
            $image_name=  $path."/".time().$item.$ext;
            $image_src= $image_src."/".time().$item.$ext;
            $imgeData = base64_decode($img_base64);
           // file_put_contents($image_name, base64_decode($img_base64));
        //

            file_put_contents($image_name, $imgeData);


            $image->removeAttribute('src');
            $image->setAttribute('src', $image_src);
         }

        $new_th_detail =  $dom->saveHTML( $dom->documentElement);

      } catch (\Exception $e) {


      }




      try {
        $new_en_detail =  $request->new_en_detail;
        $dom = new \DomDocument('1.0', 'UTF-8');

      //  $dom->substituteEntities = false;
        $dom->loadHTML(mb_convert_encoding($new_en_detail, 'HTML-ENTITIES', 'utf-8'));

        $imageFile = $dom->getElementsByTagName('img');

        foreach($imageFile as $item => $image){
            $data = $image->getAttribute('src');
            list($type, $data) = explode(';', $data);
            list(, $img_base64) = explode(',', $data);


            $image_name= "/upload/" .$doc_type .'/'.$unid ;
            $image_src= "/upload/" .$doc_type .'/'.$unid ;
            $path = public_path() . $image_name;

            if(!File::isDirectory($path)){

                File::makeDirectory($path, 0775, true, true);

            }


            $ext= $this->getextension($type);
            $image_name=  $path."/".time().$item.$ext;
            $image_src= $image_src."/".time().$item.$ext;
            $imgeData = base64_decode($img_base64);

            file_put_contents($image_name, $imgeData);
          // dd($image_name);
            $image->removeAttribute('src');
            $image->setAttribute('src', $image_src);
         }

        $new_en_detail =  $dom->saveHTML( $dom->documentElement);

      } catch (\Exception $e) {


      }

        $act=  News::where('unid','=',$unid)->update([

            'new_date' => $new_date,
            'new_th_title' => $new_th_title,
            'new_th_detail' => $new_th_detail,
            'new_en_title' => $new_en_title,
            'new_en_detail' => $new_en_detail,
            'new_status' => $new_status,
            'modify_by' => $userName,
            'modify_time' => $create_time,

        ]);

        if ($act) {
            if ($request->hasFile('img_thumb')) {
                $file = $request->file('img_thumb');
                // foreach ($files as $file) {
                $uploadFile = new uploadFilecontroller();
                $saveimg = $uploadFile->saveFile($unid, $doc_type,$img_group, $file);
                if($saveimg!=''){
                    News::where('unid','=',$unid)->update(['img_thumb' =>$saveimg]);
                }

            }
        }

    return redirect($doc_type)->with('msg', $act);
    }

    function delete(Request $request){
        $unid =$request->unid;

            $act=  News::where('unid','=',$unid)->delete();
            if($act){
                $msg="ลบสำเสร็จ";
                $result="success";
            } else {
                $msg="เกิดข้อผิดพลาด";
                $result="error";
            }

            return response()->json(['result'=> $result,'msg'=> $msg],200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);

    }

    function album(Request $request){
        $unid =$request->unid;
        $datarow = News::where('unid','=',$unid)->first();
        $dataAlbum = Uploadfile::where('ref_unid','=',$unid)->where('img_group','=','album')->get();
        return view('news.album' ,compact('datarow','dataAlbum'));
    }


    function savealbum(Request $request){

        $validated = $request->validate([
            'unid' => 'required',

        ],[
            'unid.required' => 'กรุณาใส่ข้อมูล',
        ]);

        $act = false;
        $userName = "sysadmin2";
        $unid =$request->unid;
        $doc_type=$request->doc_type;
        $img_group="album";
        $act= News::where('unid','=',$unid)->count();

    if ($request->hasFile('img_thumb')) {
        $files = $request->file('img_thumb');
            foreach ($files as $file) {
            $uploadFile = new uploadFilecontroller();
            $saveimg = $uploadFile->saveFile($unid, $doc_type,$img_group, $file);

        }
    }


       return back();
    }


    function deleteImg(Request $request){

        $doc_type =$request->doc_type;
        $ref_unid =$request->ref_unid;
        $img_unid =$request->img_unid;

        $file =Uploadfile::where('unid','=',$img_unid)->first();
        $file_name= public_path().'/upload/'.$doc_type.'/'.$ref_unid.'/'. $file->img_name;
        //dd($file_name);
            $act=  File::delete($file_name);

            if($act){
                Uploadfile::where('unid','=',$img_unid)->delete();

                $msg="ลบสำเสร็จ";
                $result="success";
            } else {
                $msg="เกิดข้อผิดพลาด";
                $result="error";
            }

            return response()->json(['result'=> $result,'msg'=> $msg],200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);

    }



}
