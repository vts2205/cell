<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if(auth()->check()){
            if(auth()->user()->is_admin=='1'){
            return redirect()->intended(url('admin/users'));
            }else{
            return redirect()->intended(url('user/dashboard'));
            }
        }else{
            return view('auth.login');
        }
    // return view('auth.login');
});

Route::get('/seed',function(){
Artisan::call('db:seed');
return 'db seeded';
});
/*
Route::get('/foo', function () {
 $target = '/home/webstormers-demo/storage/app/public';
   $shortcut = '/home/webstormers-demo/public_html/storage'; //storage folder should not be there !
   symlink($target, $shortcut);
});*/
Route::get('/home', function () {
    if(auth()->check()){
            if(auth()->user()->is_admin=='1'){
            return redirect()->intended(url('admin/users'));
            }else{
            return redirect()->intended(url('user/dashboard'));
            }
        }else{
            return view('auth.login');
        }
    // return view('auth.login');
});
// Route::get('/test', function () {
//     return view('content');
// });

Auth::routes();

Route::group(['namespace' => 'Admin','middleware' =>['auth','admin'],'prefix' =>'admin'],function(){
    Route::get('/dashboard', function () {
    return view('admin.dashboard');
    });
// users
Route::get('/users','UserController@index')->name('all users');
Route::put('/user/action','UserController@action')->name('user-action');
Route::get('/users/create','UserController@create')->name('user-register');
Route::get('/{id}/users','UserController@edit')->name('user-edit');
Route::put('/{id}/users','UserController@update')->name('update-user-data');
Route::post('/users','UserController@store')->name('user-register');
Route::put('/{id}/user','UserController@action')->name('user-action');
Route::get('/{id}/user','UserController@userDetails')->name('User profile');
Route::post('/generate/', 'UserController@account');
Route::post('/register/', 'UserController@register');
Route::get('/profile/search','UserController@profileSearch')->name('User profile Search');
//branches
Route::get('/branch','BranchController@index')->name('all branches');  
Route::get('/branch/create','BranchController@create')->name('create branch');  
Route::post('/branch','BranchController@store')->name('create branch');  
Route::get('{id}/branch/', 'BranchController@edit')->name('edit branch');
Route::put('{id}/branch','BranchController@update')->name('create branch');
Route::delete('/{id}/branch', 'BranchController@destroy')->name('delete branch');
//reports
Route::get('/reports', 'ReportsController@index')->name('all reports');
Route::post('/reports/export', 'ReportsController@generateReports')->name('generate reports');
//pay
Route::get('/payment', 'AdminController@index')->name('Payment');
   Route::get('/qrcode','AdminController@qrCodeGenerate')->name('qrcode');
   Route::get('/pay',function(){
    return view('admin.pay-details.qrcode-scanner');
   });
Route::post('/qr-scan/verify','AdminController@qrUserCheck');
   Route::get('/qr-scan/validate','AdminController@finalValidate');
   Route::get('/qr-scan/verify',function(){
    return redirect('/payment');
   });

   Route::post('/pay','AdminController@payAmount');
//update profile
      Route::get('{id}/profile','AdminController@viewProfile')->name('Profile');
   Route::put('{id}/profile','AdminController@updateUserDetails')->name('Profile');
});
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['namespace' => 'User','middleware' => ['auth','users'],'prefix' => 'user'],function(){
   Route::get('/dashboard','UserDashboardController@index')->name('user dashboard');
   Route::get('{id}/profile','UserDashboardController@viewProfile')->name('Profile');
   Route::put('{id}/profile','UserDashboardController@updateUserDetails')->name('Profile');
   Route::get('/qrcode','UserDashboardController@qrCodeGenerate')->name('qrcode');
   Route::get('/pay',function(){
    return view('user.qrcode-scanner');
   });
   Route::post('/qr-scan/verify','UserDashboardController@qrUserCheck');
   Route::get('/qr-scan/validate','UserDashboardController@finalValidate');
   Route::get('/qr-scan/verify',function(){
    return redirect('/home');
   });

   Route::post('/pay','UserDashboardController@payAmount');
    // return view('user.dashboard');


});
Route::get('/logout','Auth\LoginController@logout')->name('logout');
// Route::get('/foo', function () {
// 	// dd(Hash::make('12345678'));
//    $target = '/var/www/html/cells/storage/app/public';
  //   $shortcut = '/var/www/html/cells/public/storage'; 
    //  print(symlink($target, $shortcut));
 //});


Route::get('/image/qrcode/{id}/{process}', 'AuthenticationController@qrImgAccess')->where('process', 'android');;




