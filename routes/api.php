<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CouponsController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\InviteesController;
use App\Http\Controllers\VisitorsController;
use App\Http\Controllers\StaffCategoryController;
use App\Http\Controllers\GovernmentStaffController;
use App\Http\Controllers\GovernmentOrganizationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Using Resource controller to avoid making multiple route for same controllers
Route::resource('/visitors', VisitorsController::class);

Route::group(['auth' => 'sanctum'], function () {

    Route::resource('governmentOrganization', GovernmentOrganizationController::class)->names([
        'index'   => 'api.governmentOrganization.index',
        'store'   => 'api.governmentOrganization.store',
        'update'  => 'api.governmentOrganization.update',
        'destroy' => 'api.governmentOrganization.destroy',
    ]);

    Route::resource('governmentStaff', GovernmentStaffController::class)->names([
        'index'   => 'api.governmentStaff.index',
        'store'   => 'api.governmentStaff.store',
        'update'  => 'api.governmentStaff.update',
        'destroy' => 'api.governmentStaff.destroy',
    ]);

    Route::resource('invitees', InviteesController::class)->names([
        'index'   => 'api.invitees.index',
        'store'   => 'api.invitees.store',
        'update'  => 'api.invitees.update',
        'destroy' => 'api.invitees.destroy',
    ]);

    Route::resource('staffCategory', StaffCategoryController::class)->names([
        'index'   => 'api.staffCategory.index',
        'store'   => 'api.staffCategory.store',
        'update'  => 'api.staffCategory.update',
        'destroy' => 'api.staffCategory.destroy',
    ]);


    // Program API Start
    Route::post('/addProgram', [ProgramController::class, 'addProgram'])->name('request.addProgram');
    Route::post('/updateProgram/{uid}', [ProgramController::class, 'updateProgram'])->name('request.updateProgram');
    Route::get('/programsData', [ProgramController::class, 'programsData'])->name('request.programsData');
    Route::post('/deleteProgram', [ProgramController::class, 'deleteProgram'])->name('request.deleteProgram');
    // Program API End

    // Coupon API Start
    Route::post('/addCoupon', [CouponsController::class, 'addCoupon'])->name('request.addCoupon');
    Route::post('/updateCoupon/{uid}', [CouponsController::class, 'updateCoupon'])->name('request.updateCoupon');
    Route::get('/couponsData', [CouponsController::class, 'couponsData'])->name('request.couponsData');
    Route::post('/deleteCoupon', [CouponsController::class, 'deleteCoupon'])->name('request.deleteCoupon');
    // Coupon API End

    // Country API Start
    Route::post('/addCountry', [CountryController::class, 'create'])->name('request.addCountry');
    Route::post('/updateCountry/{id}', [CountryController::class, 'update'])->name('request.updateCountry');
    Route::get('/countryData', [CountryController::class, 'read'])->name('request.countryData');
    Route::post('/deleteCountry', [CountryController::class, 'delete'])->name('request.deleteCountry');
    // Country API End

    // City API Start
    Route::post('/addCity', [CitiesController::class, 'create'])->name('request.addCity');
    Route::post('/updateCity/{id}', [CitiesController::class, 'update'])->name('request.updateCity');
    Route::get('/cityData', [CitiesController::class, 'read'])->name('request.cityData');
    Route::post('/deleteCity', [CitiesController::class, 'delete'])->name('request.deleteCity');
    // City API End

    // Group API Start
    Route::post('/addGroup', [GroupController::class, 'create'])->name('request.addGroup');
    Route::post('/updateGroup/{uid}', [GroupController::class, 'update'])->name('request.updateGroup');
    Route::get('/groupData', [GroupController::class, 'read'])->name('request.groupData');
    Route::post('/deleteGroup', [GroupController::class, 'delete'])->name('request.deleteGroup');
    // Group API End
});
