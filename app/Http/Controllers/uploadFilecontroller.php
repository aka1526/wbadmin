<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use File;
use Image;

use App\Models\Uploadfile;


class uploadFilecontroller extends Controller
{



    public function randUNID()
    {
        $table = 'uploadfile';
        $number = date("ymdhis", time());
        $length = 7;

        do {
            for ($i = $length; $i--; $i > 0) {
                $number .= mt_rand(0, 9);
            }
        } while (!empty(DB::table($table)->where('unid', $number)->first(['unid'])));

        return $number;
    }

    public function index()
    {
        return view('image');
    }

    public function viewFile($UNID,Request $request)
    {
        //dd($request->all());
        $download=isset($request->download) ? $request->download : 0;
        $files= Uploadfile::where('UNID','=',$UNID)->first();

        $FILE_EXTENSION =$files->FILE_EXTENSION;
        $FILE_RDN_NAME =$files->FILE_RDN_NAME;
        $FILE_NAME =$files->FILE_NAME;
        $DAR_UNID =$files->DAR_UNID;
        $DOC_UNID =$files->DOC_UNID;
        $html="";
        $file_download="";

        if($DAR_UNID!=0){
            $html ='<a href="?download=1"  class="btn btn-primary " target="">Download File</a>';
            if($DAR_UNID !=''){
                $file_download='./upload/'.$DAR_UNID.'/'.$FILE_RDN_NAME ;
                if(strtolower($FILE_EXTENSION)=="jpg"){
                    $html .='<div align="center"><img src="/upload/'.$DAR_UNID.'/'.$FILE_RDN_NAME.'" alt="Girl in a jacket" width="500" height="600"></div>';
                } else if(strtolower($FILE_EXTENSION)=="png"){
                    $html .='<div align="center"><img src="/upload/'.$DAR_UNID.'/'.$FILE_RDN_NAME.'" alt="Girl in a jacket" width="500" height="600"></div>';
                }else if(strtolower($FILE_EXTENSION)=="gif"){
                    $html .='<div align="center"><img src="/upload/'.$DAR_UNID.'/'.$FILE_RDN_NAME.'" alt="Girl in a jacket" width="500" height="600" ></div>';
                }else if(strtolower($FILE_EXTENSION)=="pdf"){
                    $html .='<div align="center"><iframe src= "/upload/'.$DAR_UNID.'/'.$FILE_RDN_NAME.'" style="width:100%; height:800px;" frameborder="0"></iframe></div>';
                }else {
                    $html .=$FILE_NAME .'<br/>';
                }

            }

        } else {
            if($DOC_UNID !=''){
                $html ='<a href="?download=1"  class="btn btn-primary" target="">Download File</a>';
                $file_download='./upload/'.$DOC_UNID.'/'.$FILE_RDN_NAME ;
                if(strtolower($FILE_EXTENSION)=="jpg"){
                    $html .='<div align="center"><img src="/upload/'.$DOC_UNID.'/'.$FILE_RDN_NAME.'" alt="Girl in a jacket" width="500" height="600"></div>';
                } else if(strtolower($FILE_EXTENSION)=="png"){
                    $html .='<div align="center"><img src="/upload/'.$DOC_UNID.'/'.$FILE_RDN_NAME.'" alt="Girl in a jacket" width="500" height="600"></div>';
                }else if(strtolower($FILE_EXTENSION)=="gif"){
                    $html .='<div align="center"><img src="/upload/'.$DOC_UNID.'/'.$FILE_RDN_NAME.'" alt="Girl in a jacket" width="500" height="600" ></div>';
                }else if(strtolower($FILE_EXTENSION)=="pdf"){
                    $html .='<div align="center"><iframe src= "/upload/'.$DOC_UNID.'/'.$FILE_RDN_NAME.'" style="width:100%; height:800px;" frameborder="0"></iframe></div>';
                }else {
                    $html .=$FILE_NAME .'<br/>';
                }

            }

        }


       if( $download){
        return response()->download($file_download);
       }

        return view('upload.files.view',compact('html'));
    }


    public function getFile($DAR_UNID)
    {

        $files= Uploadfile::where('DAR_UNID','=',$DAR_UNID)
        ->orderby('DAR_NO_REV')
        ->orderBy('FILE_INDEX')->get();

        return $files;
    }


    public function delete(Request $request) {

        $UNID =   $request->UNID;
        $file=  Uploadfile::where('UNID','=',$UNID)->first();
        $DAR_UNID =$file->DAR_UNID;
        $filename= public_path()."/upload/".$DAR_UNID."/".$file->FILE_RDN_NAME;
        $act=false;
        if($DAR_UNID){
            $act= File::delete($filename);
        }

        if($act){
              Uploadfile::where('UNID','=',$UNID)->delete();
            $icon="success";
            $msg="ลบสำเสร็จ";
            $result="success";
        } else {
            $icon="error";
            $msg="ไม่สามารถลบ File ที่ต้องการได้".$filename;
            $result="error";
        }

        return response()->json(['result'=> $result,'icon'=>$icon,'msg'=> $msg],200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);

    }

    //saveFile($unid, $path_img,  $file);
    public function saveFile($ref_unid='', $path_img='',$img_group, $file)
    {
        $random = Str::random(3);
        $image =$file;
        $file_name = $file->getclientoriginalname();
        $file_rdn_name =$random.'_'. $file->getclientoriginalname();
        $file_extension = $file->extension();

        $unid = $this->randunid();
        $user = "sys";
        $img_status="Y";
        $create_time = carbon::now()->format('y-m-d h:i:s');
        $modify_time = carbon::now()->format('y-m-d h:i:s');
        $path="/upload/".'/'.$path_img."/".$ref_unid.'/';

        $filePath = public_path().$path;

        if(!File::isDirectory($filePath)){

            File::makeDirectory($filePath, 0777, true, true);

        }

        $img = Image::make($image->path());
        $act =  $img->resize(800, 600, function ($const) {
            $const->aspectRatio();
        })->save($filePath.'/'.$file_rdn_name);


        // Save to thumbnails
        $thumbnails = public_path().$path.'/thumbnails';

        if(!File::isDirectory($thumbnails)){

            File::makeDirectory($thumbnails, 0777, true, true);

        }
        $img->resize(220, 180, function ($const) {
            $const->aspectRatio();
        })->save($thumbnails.'/'.$file_rdn_name);


       // $act = $file->move(public_path().$path, $file_rdn_name);

        if ($act) {
            Uploadfile::insert([
                'unid' => $unid,
                'ref_unid' =>$ref_unid,
                'img_group'=> $img_group,
                'img_path' =>$path_img,
                'img_name' =>$file_rdn_name,
                'img_extention' =>$file_extension ,
                'img_status' => $img_status ,
                'create_by' =>$user,
                'create_time' => $create_time,
                'modify_by' =>$user,
                'modify_time'=> $create_time,
             ]);

        } else {
            $file_rdn_name="";
        }


      return $file_rdn_name;

    }



}
