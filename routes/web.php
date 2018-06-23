<?php

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
    return redirect('acneseries');
});

Route::get('/acneseries/{y}', function ($y) {
    return view('welcome',compact('y'));
});

Route::get('/acneseries', function () {
    return view('nonreselleracne');
});

Route::get('export', function () {
    return \Excel::download(new App\Exports\PembelianExport, 'invoices.xlsx');
});

//Operator Routes
Route::resource('/admin/broadcast','BroadcastController');
Route::get('admin/broadcast/delete/{id}','BroadcastController@destroy');
// Route::get('admin/broadcast/finish','BroadcastController@finish');
Route::resource('/admin/content','ContentController');
Route::get('admin/content/delete/{id}','ContentController@destroy');
Route::get('admin/content/download/{id}','ContentController@download');

Route::resource('/admin/barang','BarangController');
Route::get('admin/barang/delete/{id}','BarangController@destroy');

Route::resource('/admin/pembelian','PembelianController');
Route::get('admin/pembelian/delete/{id}','PembelianController@destroy');
Route::put('admin/pembelian/pembayaran/{bayar}','PembelianController@bayar');

//Head Admin Routes
Route::resource('/headadmin/broadcast','HeadbroadcastController');
Route::get('headadmin/broadcast/delete/{id}','HeadbroadcastController@destroy');
Route::resource('/headadmin/content','HeadcontentController');
Route::resource('/headadmin/users','MitraController');
Route::get('headadmin/users/delete/{id}','MitraController@destroy');

//Mitra Routes
Route::resource('mitra/datapembelian','DatapembelianController');
Route::resource('mitra/barang','MitrabarangController');
Route::get('mitra/barang/delete/{id}','MitrabarangController@destroy');
Route::resource('mitra/resi','ResiController');
Route::get('mitra/print/{id}','DatapembelianController@print');


//Konsumen pembelian
Route::get('pembelian','KonsumenbeliController@index');
Route::get('pembelian/{mobsterid}','KonsumenbeliController@indexreseller');
Route::post('pembelian/store/{mobsterid}','KonsumenbeliController@store');
Route::post('pembelian/store','KonsumenbeliController@storenon');

//Reseller
Route::resource('reseller','ResellerController');

Route::get('whitening/{x}', function ($x) {
    return view('beautyskywhiteningseries',compact('x'));
});
Route::get('whitening', function () {
    return view('whiteningnonreseller');
});

Route::resource('test','TestajaController');

Route::get('/send/email', 'HomeController@mail');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('error',function(){
  return view('404');
});
