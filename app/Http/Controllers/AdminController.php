<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;

use App\Models\User;


class AdminController extends Controller
{
    protected  $paging =10;

    public function randUNID($table ){

        $number = date("ymdhis", time());
        $length=7;

        do {
            for ($i=$length; $i--; $i>0) {
                $number .= mt_rand(0,9);
            }
        } while ( !empty(DB::table($table)->where('UNID', $number)->first(['UNID'])) );

        return $number;
    }



public function create(Request $request){

    return view('admin.login');
}

public function login(LoginRequest $request)
{
    $request->authenticate();

    $request->session()->regenerate();
    return redirect('/');
  //  return redirect()->intended(RouteServiceProvider::HOME);
}


public function logout(Request $request)
{
    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/login');
}


function index(Request $request){

        //$PurposeMenus = Purpose::where('PURPOSE_STATUS','=','Y')->orderBy('PURPOSE_CODE','asc')->get();;
       $dataset = User::where('webapp','=','DCC')->orderBy('id','asc')->paginate($this->paging);
       return view('admin.index' ,compact('dataset'));
}

function newuser(Request $request){

    //$PurposeMenus = Purpose::where('PURPOSE_STATUS','=','Y')->orderBy('PURPOSE_CODE','asc')->get();;
 //  $dataset = user::where('webapp','=','DCC')->orderBy('id','asc')->paginate($this->paging);
 $SECTION =Section::where('SEC_STATUS','=','Y')->orderBY('SEC_INDEX')->get();
   return view('admin.newuser',compact('SECTION'));
}

function register(Request $request){


    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'password' => ['required', 'confirmed'],
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->name.'@dcc.com',
        'fullname' =>$request->fullname,
        'user_level' => $request->user_level,
        'password' => Hash::make($request->password),
    ]);

    $dataset = user::orderBy('id','asc')->paginate($this->paging);
    $msg="บันทึกสำเร็จ";
    return  redirect('/admin')->with('msg', $msg);
}

function edituser(Request $request,$id){

    //$PurposeMenus = Purpose::where('PURPOSE_STATUS','=','Y')->orderBy('PURPOSE_CODE','asc')->get();;
 //  $dataset = user::where('webapp','=','DCC')->orderBy('id','asc')->paginate($this->paging);

$User= User::where('id','=',$id)->first();


   return view('admin.edituser',compact('User'));
}


function updateuser(Request $request){


    $user = User::where('id','=',$request->id)->update([
        'name' => $request->name,
        'fullname' =>$request->fullname,
    ]);

    $msg="บันทึกสำเร็จ";
     return  redirect('/admin')->with('msg', $msg);
}

function editpwd(Request $request,$id){

    $User= User::where('id','=',$id)->first();
    return view('admin.editpwd',compact('User'));

}

function updatepwd(Request $request){



    $request->validate([
        'id' => ['required', 'string', 'max:255'],
        'password' => ['required', 'confirmed'],
    ]);

    $user = User::where('id','=',$request->id)->update([

        'password' => Hash::make($request->password),

    ]);

    $msg="บันทึกสำเร็จ";
     return  redirect('/admin')->with('msg', $msg);
}

function deleuser(Request $request){
    $id=$request->id;
    $act= User::where('id','=',$id)->delete();

    if($act){

        $icon='success';
        $msg='บันทึกสำเสร็จ';
    } else {
       $icon='error';
       $msg='เกิดข้อผิดพลาด';
    }
    return response()->json([ 'result'=>$act,'icon'=>$icon,'msg'=> $msg],200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);


}




function userprofile(Request $request){

    $id= auth()->user()->id;
    $User= User::where('id','=',$id)->first();

    return view('user.profile',compact('User'));

}

function updateprofile(Request $request){

    $id= auth()->user()->id;
    $User= User::where('id','=',$id)->update([
       // 'name' => $request->name,
        'fullname' =>$request->fullname,


    ]);

    $msg="บันทึกสำเร็จ";
    return redirect('/')->with('msg', $msg);

}


function userpwd(Request $request){

    $id= auth()->user()->id;
    $User= User::where('id','=',$id)->first();

    return view('user.pwd',compact('User'));

}



function updateuserpwd(Request $request){


    $id= auth()->user()->id;
    $request->validate([

        'password' => ['required', 'confirmed'],
    ]);

    $user = User::where('id','=',$id)->update([

        'password' => Hash::make($request->password),

    ]);

    $msg="บันทึกสำเร็จ";
     return  redirect('/')->with('msg', $msg);
}

}
