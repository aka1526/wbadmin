<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\AdminController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AwardsController;
use App\Http\Controllers\CsrsController;
use App\Http\Controllers\ActivitysController;
use App\Http\Controllers\VisitorsController;
use App\Http\Controllers\TelevisionsController;

use App\Http\Controllers\PartnersController;
use App\Http\Controllers\CustomerlistController;
use App\Http\Controllers\SlidesimgController;
use App\Http\Controllers\WebmenuController;
use App\Http\Controllers\WebsubmenuController;
use App\Http\Controllers\MachinegroupController;
use App\Http\Controllers\MachineController;

use App\Http\Controllers\CustomerController;

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
        Route::get('/','home');

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


        Route::get('/visitors','index')->name('visitors.index');
        Route::post('/visitors/save', 'save');
        Route::get('/visitors/edit/{unid}', 'edit')->name('visitors.edit');
        Route::post('/visitors/update','update');
        Route::post('/visitors/delete',  'delete')->name('visitors.delete');
        Route::get('/visitors/album/{unid}', 'album')->name('visitors.album');
        Route::post('/visitors/album/save', 'savealbum');
        Route::post('/visitors/album/delete', 'deleteImg');


        Route::get('/televisions','index')->name('televisions.index');
        Route::post('/televisions/save', 'save');
        Route::get('/televisions/edit/{unid}', 'edit')->name('televisions.edit');
        Route::post('/televisions/update','update');
        Route::post('/televisions/delete',  'delete')->name('televisions.delete');
        Route::get('/televisions/album/{unid}', 'album')->name('televisions.album');
        Route::post('/televisions/album/save', 'savealbum');
        Route::post('/televisions/album/delete', 'deleteImg');


        Route::get('/slides','index')->name('slides.index');
        Route::post('/slides/save', 'save');
        Route::get('/slides/edit/{unid}', 'edit')->name('slides.edit');
        Route::post('/slides/update','update');
        Route::post('/slides/delete',  'delete')->name('slides.delete');
        Route::get('/slides/album/{unid}', 'album')->name('slides.album');
        Route::post('/slides/album/save', 'savealbum');
        Route::post('/slides/album/delete', 'deleteImg');


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

        Route::controller(VisitorsController::class)->group(function(){
            Route::get('/visitors/add', 'add')->name('visitors.add');
        });

        Route::controller(TelevisionsController::class)->group(function(){
            Route::get('/televisions/add', 'add')->name('televisions.add');
        });


        Route::controller(CustomerlistController::class)->group(function(){
            Route::get('/Customerlist','index')->name('Customerlist.index');
            Route::get('/Customerlist/add', 'add')->name('Customerlist.add');
            Route::post('/Customerlist/save', 'save');
            Route::get('/Customerlist/edit/{unid}', 'edit')->name('Customerlist.edit');
            Route::post('/Customerlist/update','update');
            Route::post('/Customerlist/delete',  'delete')->name('Customerlist.delete');

        });

        Route::controller(PartnersController::class)->group(function(){
            Route::get('/partners','index')->name('partners.index');
             Route::get('/partners/add', 'add')->name('partners.add');
            Route::post('/partners/save', 'save');
            Route::get('/partners/edit/{unid}', 'edit')->name('partners.edit');
            Route::post('/partners/update','update');
            Route::post('/partners/delete',  'delete')->name('partners.delete');

        });

        Route::controller(SlidesimgController::class)->group(function(){
            Route::get('/slides','index')->name('slides.index');
             Route::get('/slides/add', 'add')->name('slides.add');
            Route::post('/slides/save', 'save');
            Route::get('/slides/edit/{unid}', 'edit')->name('slides.edit');
            Route::post('/slides/update','update');
            Route::post('/slides/delete',  'delete')->name('slides.delete');

        });

        Route::controller(WebmenuController::class)->group(function(){
            Route::get('/webmenu','index')->name('webmenu.index');
             Route::get('/webmenu/add', 'add')->name('webmenu.add');
            Route::post('/webmenu/save', 'save');
            Route::get('/webmenu/edit/{unid}', 'edit')->name('webmenu.edit');
            Route::post('/webmenu/update','update');
            Route::post('/webmenu/delete',  'delete')->name('webmenu.delete');

        });

        Route::controller(WebsubmenuController::class)->group(function(){
            Route::get('/websubmenu','index')->name('submenu.index');
             Route::get('/websubmenu/add', 'add')->name('submenu.add');
            Route::post('/websubmenu/save', 'save');
            Route::get('/websubmenu/edit/{unid}', 'edit')->name('submenu.edit');
            Route::post('/websubmenu/update','update');
            Route::post('/websubmenu/delete',  'delete')->name('submenu.delete');

        });


        Route::controller(MachinegroupController::class)->group(function(){
            Route::get('/machine/group','index')->name('machine.group.index');
             Route::get('/machine/group/add', 'add')->name('machine.group.add');
            Route::post('/machine/group/save', 'save')->name('machine.group.save');
            Route::get('/machine/group/edit/{unid}', 'edit')->name('machine.group.edit');
            Route::post('/machine/group/update','update')->name('machine.group.update');
            Route::post('/machine/group/delete',  'delete')->name('machine.group.delete');

        });


        Route::controller(MachineController::class)->group(function(){
            Route::get('/machine','index')->name('machine.index');
             Route::get('/machine/add', 'add')->name('machine.add');
            Route::post('/machine/save', 'save')->name('machine.save');
            Route::get('/machine/edit/{unid}', 'edit')->name('machine.edit');
            Route::post('/machine/update','update')->name('machine.update');
            Route::post('/machine/delete',  'delete')->name('machine.delete');

        });

        Route::controller(CustomerController::class)->group(function(){
            Route::get('/customer','index')->name('customer.index');
            Route::get('/customer/add', 'add')->name('customer.add');
            Route::post('/customer/save', 'save')->name('customer.save');
            Route::get('/customer/edit/{unid}', 'edit')->name('customer.edit');
            Route::post('/customer/update','update')->name('customer.update');
            Route::post('/customer/delete',  'delete')->name('customer.delete');

        });


});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');





require __DIR__.'/auth.php';
