<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\AdminController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AwardsController;
use App\Http\Controllers\CsrsController;
use App\Http\Controllers\ActivitysController;

use App\Http\Controllers\AlbumController;
// Route::get('/', function () {
//     return view('news.index');
// });


// Protect Group
Route::middleware(['auth'])->group(function(){

    Route::controller(AdminController::class)->group(function(){
        Route::get('logout',  'logout')->name('admin.logout');
      /*  Route::get('admin','index')->name('admin.index');
        Route::get('admin/newuser','newuser')->name('admin.newuser');
        Route::post('admin/register','register')->name('admin.register');
        Route::get('admin/edituser/{id}','edituser')->name('admin.edituser');
        Route::post('admin/updateuser','updateuser')->name('admin.updateuser');

        Route::get('admin/editpwd/{id}','editpwd')->name('admin.editpwd');
        Route::post('admin/updatepwd','updatepwd')->name('admin.updatepwd');

        Route::post('admin/deleuser','deleuser')->name('admin.deleuser');
*/
        Route::get('user/userprofile','userprofile')->name('user.userprofile');
        Route::post('user/updateprofile','updateprofile')->name('user.updateprofile');
        Route::get('user/userpwd','userpwd')->name('user.userpwd');
        Route::post('user/updateuserpwd','updateuserpwd')->name('user.updateuserpwd');


    });


    Route::controller(NewsController::class)->group(function(){
        Route::get('/','index');

        Route::get('/news','index')->name('news.index');
        Route::get('/news/add', 'add')->name('news.add');
        Route::post('/news/save', 'save');
        Route::get('/news/edit/{unid}', 'edit')->name('news.edit');
        Route::post('/news/update','update');
        Route::post('/news/delete',  'delete')->name('news.delete');

        Route::get('/news/album/{unid}', 'album')->name('news.album');
        Route::post('/news/album/save', 'savealbum');
        Route::post('/news/album/delete', 'deleteImg');


        Route::get('/awards','index')->name('awards.index');
        Route::post('/awards/save', 'save');
        Route::get('/awards/edit/{unid}', 'edit')->name('awards.edit');
        Route::post('/awards/update','update');
        Route::post('/awards/delete',  'delete')->name('awards.delete');
        Route::get('/awards/album/{unid}', 'album')->name('awards.album');
        Route::post('/awards/album/save', 'savealbum');
        Route::post('/awards/album/delete', 'deleteImg');


        Route::get('/csrs','index')->name('csrs.index');
        Route::post('/csrs/save', 'save');
        Route::get('/csrs/edit/{unid}', 'edit')->name('csrs.edit');
        Route::post('/csrs/update','update');
        Route::post('/csrs/delete',  'delete')->name('csrs.delete');
        Route::get('/csrs/album/{unid}', 'album')->name('csrs.album');
        Route::post('/csrs/album/save', 'savealbum');
        Route::post('/csrs/album/delete', 'deleteImg');

        Route::get('/activitys','index')->name('activitys.index');
        Route::post('/activitys/save', 'save');
        Route::get('/activitys/edit/{unid}', 'edit')->name('activitys.edit');
        Route::post('/activitys/update','update');
        Route::post('/activitys/delete',  'delete')->name('activitys.delete');
        Route::get('/activitys/album/{unid}', 'album')->name('activitys.album');
        Route::post('/activitys/album/save', 'savealbum');
        Route::post('/activitys/album/delete', 'deleteImg');


        });

        Route::controller(AlbumController::class)->group(function(){

        });

        Route::controller(AwardsController::class)->group(function(){
            Route::get('/awards/add', 'add')->name('awards.add');
        });

        Route::controller(CsrsController::class)->group(function(){
            Route::get('/csrs/add', 'add')->name('csrs.add');
        });


        Route::controller(ActivitysController::class)->group(function(){
            Route::get('/activitys/add', 'add')->name('activitys.add');
        });


});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');





require __DIR__.'/auth.php';
