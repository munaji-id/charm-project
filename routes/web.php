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

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ModulController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TipeuserController;
use App\Http\Controllers\TipeattachmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CrController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectmodController;

Route::get('/', [AuthController::class, 'index'])->name('login');

Route::get('dashboard', function () {
    return view('dashboard');
});
Route::get('master-data', function () {
    return view('pages.master-data.index');
});

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
// Route::resource('cr', CrController::class)->middleware('pageuser');;
// Route::get('/getModul/{id}', [CrController::class, 'getModul']);

// Route::group(['prefix' => 'master-data'], function(){
//     Route::get('users', [UserController::class, 'index'])->name('users');
//     Route::get('users/create', [UserController::class, 'create'])->name('create');
// });

//Route Halaman All User
Route::group(['middleware'=>'pageuser'], function(){
    Route::resource('dashboard', DashboardController::class)->middleware('pageuser');
    // Route::resource('cr', CrController::class)->middleware('pageuser');
    Route::get('cr', [CrController::class, 'index'])->name('cr.index')->middleware('pageuser');
    Route::get('cr/create', [CrController::class, 'create'])->name('cr.create')->middleware('pageuser');
    Route::post('cr', [CrController::class, 'store'])->name('cr.store')->middleware('pageuser');
    Route::match(['put','patch'],'cr/{cr}', [CrController::class, 'update'])->name('cr.update')->middleware('pageuser');
    Route::get('cr/{cr}/edit', [CrController::class, 'edit'])->name('cr.edit')->middleware('pageuser');
    
    Route::match(['put', 'patch'],'cr/status_3/{id}', [CrController::class, 'status_3'])->name('cr.status_3')->middleware('pageuser');
    Route::get('/getModul/{id}', [CrController::class, 'getModul'])->middleware('pageuser');
    Route::post('cr/upload', [CrController::class, 'upload'])->name('cr.upload')->middleware('pageuser');
    Route::get('cr/{file}/download', [CrController::class, 'download'])->name('cr.download')->middleware('pageuser');
 });

//Route Halaman Admin
Route::group(['middleware'=>'pagerole'], function(){
    Route::resource('user', UserController::class)->middleware('pagerole');
    Route::resource('company', CompanyController::class)->middleware('pagerole');
    Route::resource('modul', ModulController::class)->middleware('pagerole');
    Route::resource('status', StatusController::class)->middleware('pagerole');
    Route::resource('project', ProjectController::class)->middleware('pagerole');
    // Route::resource('projectmod', ProjectmodController::class)->middleware('pagerole');
    Route::resource('tipeuser', TipeuserController::class)->middleware('pagerole');    
    Route::resource('tipeattach', TipeattachmentController::class)->middleware('pagerole');
    // Route::resource('cr', CrController::class)->middleware('pagerole');
    // Route::get('/getModul/{id}', [CrController::class, 'getModul'])->middleware('pagerole');
    // Route::delete('projectmod/{modul_id}/{project_id?}', [ProjectmodController::class, 'destroy'])->name('projectmod.destroy')->middleware('pagerole');
    Route::delete('projectmod/{modul_id}/', [
        'as' => 'projectmod.destroy', 
        'uses' => 'ProjectmodController@destroy'
    ]);
 });
    // Route::get('users', [UserController::class, 'index'])->name('users');
    // Route::get('users/create', [UserController::class, 'create'])->name('create');

Route::group(['prefix' => 'email'], function(){
    Route::get('inbox', function () { return view('pages.email.inbox'); });
    Route::get('read', function () { return view('pages.email.read'); });
    Route::get('compose', function () { return view('pages.email.compose'); });
});

Route::group(['prefix' => 'apps'], function(){
    Route::get('chat', function () { return view('pages.apps.chat'); });
    Route::get('calendar', function () { return view('pages.apps.calendar'); });
});

Route::group(['prefix' => 'ui-components'], function(){
    Route::get('accordion', function () { return view('pages.ui-components.accordion'); });
    Route::get('alerts', function () { return view('pages.ui-components.alerts'); });
    Route::get('badges', function () { return view('pages.ui-components.badges'); });
    Route::get('breadcrumbs', function () { return view('pages.ui-components.breadcrumbs'); });
    Route::get('buttons', function () { return view('pages.ui-components.buttons'); });
    Route::get('button-group', function () { return view('pages.ui-components.button-group'); });
    Route::get('cards', function () { return view('pages.ui-components.cards'); });
    Route::get('carousel', function () { return view('pages.ui-components.carousel'); });
    Route::get('collapse', function () { return view('pages.ui-components.collapse'); });
    Route::get('dropdowns', function () { return view('pages.ui-components.dropdowns'); });
    Route::get('list-group', function () { return view('pages.ui-components.list-group'); });
    Route::get('media-object', function () { return view('pages.ui-components.media-object'); });
    Route::get('modal', function () { return view('pages.ui-components.modal'); });
    Route::get('navs', function () { return view('pages.ui-components.navs'); });
    Route::get('navbar', function () { return view('pages.ui-components.navbar'); });
    Route::get('pagination', function () { return view('pages.ui-components.pagination'); });
    Route::get('popovers', function () { return view('pages.ui-components.popovers'); });
    Route::get('progress', function () { return view('pages.ui-components.progress'); });
    Route::get('scrollbar', function () { return view('pages.ui-components.scrollbar'); });
    Route::get('scrollspy', function () { return view('pages.ui-components.scrollspy'); });
    Route::get('spinners', function () { return view('pages.ui-components.spinners'); });
    Route::get('tabs', function () { return view('pages.ui-components.tabs'); });
    Route::get('tooltips', function () { return view('pages.ui-components.tooltips'); });
});

Route::group(['prefix' => 'advanced-ui'], function(){
    Route::get('cropper', function () { return view('pages.advanced-ui.cropper'); });
    Route::get('owl-carousel', function () { return view('pages.advanced-ui.owl-carousel'); });
    Route::get('sortablejs', function () { return view('pages.advanced-ui.sortablejs'); });
    Route::get('sweet-alert', function () { return view('pages.advanced-ui.sweet-alert'); });
});

Route::group(['prefix' => 'forms'], function(){
    Route::get('basic-elements', function () { return view('pages.forms.basic-elements'); });
    Route::get('advanced-elements', function () { return view('pages.forms.advanced-elements'); });
    Route::get('editors', function () { return view('pages.forms.editors'); });
    Route::get('wizard', function () { return view('pages.forms.wizard'); });
});

Route::group(['prefix' => 'charts'], function(){
    Route::get('apex', function () { return view('pages.charts.apex'); });
    Route::get('chartjs', function () { return view('pages.charts.chartjs'); });
    Route::get('flot', function () { return view('pages.charts.flot'); });
    Route::get('morrisjs', function () { return view('pages.charts.morrisjs'); });
    Route::get('peity', function () { return view('pages.charts.peity'); });
    Route::get('sparkline', function () { return view('pages.charts.sparkline'); });
});

Route::group(['prefix' => 'tables'], function(){
    Route::get('basic-tables', function () { return view('pages.tables.basic-tables'); });
    Route::get('data-table', function () { return view('pages.tables.data-table'); });
});

Route::group(['prefix' => 'icons'], function(){
    Route::get('feather-icons', function () { return view('pages.icons.feather-icons'); });
    Route::get('flag-icons', function () { return view('pages.icons.flag-icons'); });
    Route::get('mdi-icons', function () { return view('pages.icons.mdi-icons'); });
});

Route::group(['prefix' => 'general'], function(){
    Route::get('blank-page', function () { return view('pages.general.blank-page'); });
    Route::get('faq', function () { return view('pages.general.faq'); });
    Route::get('invoice', function () { return view('pages.general.invoice'); });
    Route::get('profile', function () { return view('pages.general.profile'); });
    Route::get('pricing', function () { return view('pages.general.pricing'); });
    Route::get('timeline', function () { return view('pages.general.timeline'); });
});

Route::group(['prefix' => 'master-data'], function(){
    Route::get('master-pengguna', function () { return view('pages.master-data.master-pengguna'); });
    Route::get('faq', function () { return view('pages.general.faq'); });
    Route::get('invoice', function () { return view('pages.general.invoice'); });
    Route::get('profile', function () { return view('pages.general.profile'); });
    Route::get('pricing', function () { return view('pages.general.pricing'); });
    Route::get('timeline', function () { return view('pages.general.timeline'); });
});

Route::group(['prefix' => 'auth'], function(){
    Route::get('login', function () { return view('pages.auth.login'); });
    Route::get('register', function () { return view('pages.auth.register'); });
});

Route::group(['prefix' => 'error'], function(){
    Route::get('404', function () { return view('pages.error.404'); });
    Route::get('500', function () { return view('pages.error.500'); });
});

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

// 404 for undefined routes
Route::any('/{page?}',function(){
    return View::make('pages.error.404');
})->where('page','.*');
