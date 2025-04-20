<?php

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LawsController;
use App\Http\Controllers\DekasController;
use App\Http\Controllers\LawcatsController;
use App\Http\Controllers\SearchsController;
use App\Http\Controllers\MainlawsController;
use App\Http\Controllers\BookmarksController;
use App\Http\Controllers\SelectedLawsController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\admin\CoreLawsController;
use App\Http\Controllers\admin\DekaLawsController;
use App\Http\Controllers\admin\KeywordsController;
use App\Http\Controllers\admin\LawdatasController;
use App\Http\Controllers\admin\QuestionsController;
use App\Http\Controllers\Auth\ForgotPasswordController;

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

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('/', function () {
    return view('main');
});

Route::get('/test', function () {
    return view('layouts.theme2');
});


Route::middleware(['auth'])->group(function () {
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('profile/{user}', [ProfileController::class, 'update'])->name('profile.update');
});


Route::prefix('admin')
    //->middleware('auth.isAdmin')
    ->name('admin')->middleware('isadmin')->group(function () {
        Route::resource('/mainlaws', MainlawsController::class);
        Route::resource('/users', UsersController::class);
        Route::get('/dekas/listlaw/{id}', [DekaLawsController::class, 'listLaw2Deka'])->name('dekas.listlaw');
        Route::get('/dekas/addlaw/{id}', [DekaLawsController::class, 'addLaw2Deka'])->name('dekas.addlaw');
        Route::post('/dekas/addlawaction/{id}', [DekaLawsController::class, 'addLaw2DekaAction'])->name('dekas.addlawaction');
        Route::get('/dekas/deleteLaw2Deka/{id}/{dekaid}', [DekaLawsController::class, 'deleteLaw2Deka'])->name('dekas.deleteLaw2Deka');
        Route::get('/dekas/getcatbyappid/{id}', [DekaLawsController::class, 'getLawCat'])->name('dekas.getlawcat');
        Route::get('/dekas/getlawbycatid/{id}/{parent_id}', [DekaLawsController::class, 'getLaw'])->name('dekas.getlaw');
        Route::get('/dekas/getlawbyappid/{id}', [DekaLawsController::class, 'getalllaw'])->name('dekas.getalllaw');


        Route::resource('/dekas', DekaLawsController::class);
        Route::resource('/corelaws', CoreLawsController::class);


        Route::get('/lawcats/{mainlaw_id}/data/{id}/parent', [LawcatsController::class, 'parent']);
        Route::get('/lawcats/{mainlaw_id}/data/{id}/sub', [LawcatsController::class, 'sub']);
        // Route::get('/lawcats/{mainlaw_id}/datacreate', [LawcatsController::class, 'create'])->name('lawcat.data.create');
        // Route::get('/lawcats/{mainlaw_id}/data/{id}/edit', [LawcatsController::class, 'edit'])->name('lawcat.data.edit');
        // //Route::put('/lawcats/{mainlaw_id}/data/{id}', [LawcatsController::class, 'update'])->name('lawcat.data.update');
        // Route::match(['POST', 'put', 'patch'], '/lawcats/{mainlaw_id}/data/{id}/update', [LawcatsController::class, 'update'])->name('lawcat.data.update');
        // Route::delete('/lawcats/{mainlaw_id}/data/{id}/delete', [LawcatsController::class, 'destroy'])->name('lawcat.data.destroy');

        Route::resource('/lawcats/{mainlaw_id}/data', LawcatsController::class, ['as' => 'lawcat']);

        // Route::get('/lawcats/{mainlaw_id}/data', [LawcatsController::class, 'index'])->name('lawcat.data.index');
        // Route::post('/lawcats/{mainlaw_id}/data', [LawcatsController::class, 'store'])->name('lawcat.data.store');
        Route::get('/laws/{mainlaw_id}/data/{id}/sub', [LawdatasController::class, 'sub']);
        Route::resource('/laws/{mainlaw_id}/data', LawdatasController::class);

        Route::resource('/laws/{app_id}/keymaps', KeywordsController::class);

        Route::get('/questionslaw/{lawdata_id}', [QuestionsController::class, 'indexByLaw'])->name('questionslaw.list');
        Route::get('/questionslaw/{lawdata_id}/create', [QuestionsController::class, 'createByLaw'])->name('questionslaw.create');
        Route::post('/questionslaw/{lawdata_id}/store', [QuestionsController::class, 'storeByLaw'])->name('questionslaw.store');
        Route::resource('/questions', QuestionsController::class);
    });


Route::middleware('auth')->group(
    function () {
        Route::get('/search', [SearchsController::class, 'index'])->name('search');
        // Route::get('/searchact/{key}', [SearchsController::class, 'seachAction']);
        Route::get('/searchact', [SearchsController::class, 'seachAction'])->name('searchact');



        Route::get('/advancesearch', [SearchsController::class, 'advancesearch'])->name('advancesearch');
        Route::post('/advancesearchaction', [SearchsController::class, 'advancesearchaction']);

        Route::get('/lawview/{lawid}/{lawname}', [LawsController::class, 'viewlaw']);
        Route::get('/dekaview/{dekaid}/{dekaname}', [DekasController::class, 'viewdeka']);
        Route::get('/catview/{catid}/{catname}', [LawcatsController::class, 'viewcat']);

        Route::get('/bookmarks', [BookmarksController::class, 'index'])->name('bookmarks');
        Route::get('/bookmarks/addlaw2bookmark/{lawid}', [BookmarksController::class, 'addLawToDefaultFolder'])->name('bookmarks.addlaw2bookmark');
        Route::get('/bookmarks/adddeka2bookmark/{dekaid}', [BookmarksController::class, 'addDekaToDefaultFolder'])->name('bookmarks.adddeka2bookmark');
        Route::get('/bookmarks/addNote/{bookmarkid}', [BookmarksController::class, 'addNote']);
        Route::post('/bookmarks/addNoteAction/{bookmarkid}', [BookmarksController::class, 'addNoteAction']);
    }
);
Route::get('/nonmember/search', [SearchsController::class, 'nonmemberSeach'])->name('nonmember_search');
Route::get('/nonmember/searchact', [SearchsController::class, 'nonmemberSeachAction'])->name('nonmember_searchact');

Route::get('/nonmember/lawview/{lawid}/{lawname}', [LawsController::class, 'nonmember_viewlaw']);
Route::get('/nonmember/dekaview/{dekaid}/{dekaname}', [DekasController::class, 'nonmember_viewdeka']);

Route::prefix('/nonmember/lawselect/{main_id}')->group(
    function () {
        Route::get('/dashboard', [SelectedLawsController::class, 'nonmemberindex'])->name('selectlaw.nonmemberdashboard');
        // Route::get('/dashboardcat/{catId}', [SelectedLawsController::class, 'indexcat'])->name('selectlaw.dashboardcat');


        Route::get('/dashboardSection', [SelectedLawsController::class, 'nonmemberindexCatSection'])->name('selectlaw.nonmemberindexCatSection');

        Route::get('/dashboardcatHierarchy/{catId?}', [SelectedLawsController::class, 'nonmemberindexCatHierarchy'])
            ->where('catId', '.*')
            ->name('selectlaw.nonmemberdashboardcatTest');
    }
);

Route::get('/sharelawview/{lawid}/{lawno}', [LawsController::class, 'sharelawview']);

Route::get('/sharedekaview/{dekaid}/{dekaname}', [DekasController::class, 'sharedekaview']);

Route::middleware('auth')->group(
    function () {
        Route::prefix('lawselect/{main_id}')->group(
            function () {
                Route::get('/dashboard', [SelectedLawsController::class, 'index'])->name('selectlaw.dashboard');
                // Route::get('/dashboardcat/{catId}', [SelectedLawsController::class, 'indexcat'])->name('selectlaw.dashboardcat');


                Route::get('/dashboardSection', [SelectedLawsController::class, 'indexCatSection'])->name('selectlaw.indexCatSection');

                Route::get('/dashboardcatHierarchy/{catId?}', [SelectedLawsController::class, 'indexCatHierarchy'])
                    ->where('catId', '.*')
                    ->name('selectlaw.dashboardcatTest');
            }
        );
    }
);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

// URL::forceScheme('https');
