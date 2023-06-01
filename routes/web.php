<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BuchhaltungsbutlerController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PlentyMarketProdcutImportController;
use App\Http\Controllers\PlentyMarketProductController;
use App\Http\Controllers\PostingController;
use App\Http\Controllers\SkuGeneratorController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ZettleController;
use App\Jobs\SyncBuchhaltungsbutlerAccounts;
use App\Models\ZettleTransaction;
use App\Services\BuchhaltungsbutlerService;
use App\Services\PlentyMarketService;
use App\Services\ZettleService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function(){
    return redirect('/admin');
});

// Route::get('/test', function () {

//     new PlentyMarketService('MU');

//     phpinfo();
//     // return (new ZettleTransaction)->postingText('PAYOUTgg');
//     // return dd((new BuchhaltungsbutlerService)->getPostings());
//     $colors = ['red', 'green', 'blue', 'white', 'black'];
//     $sizes = ['S', 'M', 'L', 'XL', 'XXL'];
//     $models = ['a', 'b', 'c', 'd'];
//     $weight = ['1kg', '2kg', '5kg'];
//     // $skus = [];
//     // foreach($colors as $color){
//     //     foreach($sizes as $size){
//     //         foreach($models as $model){
//     //             $skus[] = $color . '-' . $size . '-' . $model;
//     //         }
//     //     }
//     // }
//     // dd($skus);
//     $combinations = [[]];
//     $data = [
//         $colors,
//         $sizes,
//         $models,
//         $weight
//     ];
//     $length = count($data);

//     for ($count = 0; $count < $length; $count++) {
//         $tmp = [];
//         foreach ($combinations as $v1) {
//             foreach ($data[$count] as $v2) {
//                 $tmp[] = array_merge($v1, [$v2]);
//             }
//         }
//         $combinations = $tmp;
//     }

//     dd($combinations);
// });
// Route::get('/lang/{locale}', function ($locale) {
//     if (!in_array($locale, ['en', 'de'])) {
//         abort(400);
//     }

//     App::setLocale($locale);
//     session()->put('locale', $locale);
//     return redirect()->back();
// });

// Route::get('/', function () {
//     return redirect('/dashboard');
// });
// Route::get('/login', [AuthenticatedSessionController::class, 'create'])->middleware('guest')->name('login');
// Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware('guest');

// Route::group(['middleware' => ['auth']], function () {
//     Route::get('/dashboard', DashboardController::class)->name('clients.dashboard');
//     Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('clients.logout');
//     Route::get('/password/change', [PasswordController::class, 'index'])->name('clients.changePassword');
//     Route::patch('/password/change', [PasswordController::class, 'update'])->name('clients.updatePassword');

//     Route::group(['middleware' => 'permission:send_sms'], function () {
//         Route::get('/sms', [SmsController::class, 'index'])->name('sms.index');
//         Route::get('/sms/datatable', [SmsController::class, 'datatable'])->name('sms.datatable');
//         Route::get('/sms/create', [SmsController::class, 'create'])->name('sms.create');
//         Route::post('/sms', [SmsController::class, 'send'])->name('sms.send');
//     });

//     Route::group(['middleware' => 'permission:manage_posting'], function () {
//         Route::get('/buchhaltungsbutler/sync', function () {
//             SyncBuchhaltungsbutlerAccounts::dispatch(auth()->user());
//             return redirect()->back()->with('message', 'Account sync successful!');
//         })->name('bhb.sync');
//         Route::get('/postings', [PostingController::class, 'index'])->name('postings.index');
//         Route::get('/postings/datatable', [PostingController::class, 'datatable'])->name('postings.datatable');
//         Route::get('/postings/create', [PostingController::class, 'create'])->name('postings.create');
//         Route::post('/postings', [PostingController::class, 'store'])->name('postings.store');
//         Route::get('/postings/{posting}', [PostingController::class, 'show'])->name('postings.show');
//         Route::get('/postings/{posting}/edit', [PostingController::class, 'edit'])->name('postings.edit');
//         Route::patch('/postings/{posting}', [PostingController::class, 'update'])->name('postings.update');
//         Route::post('/postings/{posting}/postNow', [PostingController::class, 'postNow'])->name('postings.postNow');
//     });


//     Route::group(['middleware' => 'permission:manage_zettle_transactions'], function () {
//         Route::get('/zettle', [ZettleController::class, 'index'])->name('zettle.index');
//         // Route::get('/zettle',function(ZettleService $zettle){
//         //     dd($zettle->getProducts()->json());
//         // });
//     });

//     Route::group(['middleware' => 'permission:manage_plentymarket'], function () {
//         Route::get('/plentymarket/products', [PlentyMarketProductController::class, 'index'])->name('plentyMarketProducts.index');
//         Route::get('/plentymarket/products/datatable', [PlentyMarketProductController::class, 'datatable'])->name('plentyMarketProducts.datatable');
//         Route::get('/plentymarket/products/create', [PlentyMarketProductController::class, 'create'])->name('plentyMarketProducts.create');
//         Route::post('/plentymarket/products/verify', [PlentyMarketProductController::class, 'verify'])->name('plentyMarketProducts.verify');
//         Route::get('/plentymarket/products/{product}/checkStock', [PlentyMarketProductController::class, 'checkStock'])->name('plentyMarketProducts.checkStock');
//         Route::post('/plentymarket/products', [PlentyMarketProductController::class, 'store'])->name('plentyMarketProducts.store');
//         Route::get('/plentymarket/products/{product}/edit', [PlentyMarketProductController::class, 'edit'])->name('plentyMarketProducts.edit');
//         Route::patch('/plentymarket/products/{product}', [PlentyMarketProductController::class, 'update'])->name('plentyMarketProducts.update');
//         Route::delete('/plentymarket/products/{product}', [PlentyMarketProductController::class, 'delete'])->name('plentyMarketProducts.delete');

//         Route::get('/plentymarket/import', [PlentyMarketProdcutImportController::class, 'index'])->name('plentyMarketProducts.import');
//     });
// });

// Route::prefix('admin')->group(function () {
//     Route::group(['middleware' => ['admin.auth:admin', 'permission:access_admin_dashboard']], function () {
//         Route::get('/test', function () {
//             [
//                 '9422574' .
//                     '9422575',
//                 '9423540',
//             ];
//             // $user = \App\Models\User::findOrFail(3);
//             $smoice = new \App\Services\SmoiceService;
//             // $smoice->getCustomer($user);
//             $smoice->searchCustomer('faysal@surovigroup.net');
//         });
//         Route::get('/dashboard', DashboardController::class)->name('admins.dashboard');
//         Route::get('/users', [UserController::class, 'index'])->name('users.index');
//         Route::get('/users/datatable', [UserController::class, 'datatable'])->name('users.datatable');
//         Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
//         Route::post('/users', [UserController::class, 'store'])->name('users.store');
//         Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
//         Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
//         Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update');
//     });
// });
