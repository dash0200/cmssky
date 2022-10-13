<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\Patient\PatientController;
use App\Http\Controllers\Reception\ReceptionController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [Controller::class, "dashboard"])->name('dashboard');
    
    Route::get("profile", [Controller::class, "profile"])->name("profile");
    
    Route::post("updatePassword", [Controller::class, "updatePassword"])->name("updatePassword");

    // <------------------------------- Admin Routes ---------------------------------------->
    Route::group(['middleware' => ['auth', "admin"]], function () {
        Route::controller(AdminController::class)->prefix('admin')->name("admin.")->group(function(){
            Route::get("/dashboard", "adminDashboard")->name("dashboard");
            //-----------Doctors--------------
                Route::get("/add-docotors-form", "addDoctor")->name("d.addDoctor");
                Route::post("/store-docotor", "storeDoctorInfo")->name("d.storeDoctorInfo");
                Route::get("/edit-docotor", "editDoctorInfo")->name("editDoctorInfo");
                Route::post("/update-docotor", "updateDoctorInfo")->name("d.updateDoctorInfo");
                Route::delete("/delete-docotor", "deleteDoctorInfo")->name("deleteDoctor");

                Route::get("/doctor-list", "doctorList")->name("d.doctorList");
            //-----------Doctors--------------

            //--------------Masters---------------
                Route::get("add-department-form", "addDepartment")->name("master.addDepartment");
                Route::post("store-department", "storeDepartment")->name("master.storeDepartment");
                Route::get("get-department", "getDepartments")->name("master.getDepartments");
            //--------------Masters---------------

            //--------------Receptions---------------
            Route::get("reception-form", "addReception")->name("reception.add");
            Route::post("store", "storeReception")->name("reception.store");
            Route::get("reception-list", "listReception")->name("reception.list");
            Route::get("reception-edit", "editReception")->name("reception.edit");
            Route::post("reception-update", "updateReception")->name("reception.update");
            //--------------Receptions---------------
        });
    });
    //</------------------------------- Admin Routes ----------------------------------------/>


    // <------------------------------- Doctor Routes ---------------------------------------->
    Route::group(['middleware' => ['auth', "doctor"]], function () {
        Route::controller(DoctorController::class)->prefix('doctor')->name("doctor.")->group(function(){
            Route::get("/dashboard", "doctorDashboard")->name("dashboard");
        });
    });
    //</------------------------------- Doctor Routes ----------------------------------------/>


    //<------------------------------- Patient Routes ---------------------------------------->
    Route::group(['middleware' => ['auth', "patient"]], function () {
        Route::controller(PatientController::class)->prefix('patient')->name("patient.")->group(function(){
            Route::get("/dashboard", "patientDashboard")->name("dashboard");
            Route::get("/appointments", "appointments")->name("appointments");
            Route::get("/appointments/hostory", "appointmentsHistory")->name("appointmentHistory");
            Route::post("/store", "storeAppointment")->name("storeAppointment");
        });
    });
     //</------------------------------- Patient Routes ----------------------------------------/>


     //<------------------------------- Reception Routes ---------------------------------------->
    Route::group(['middleware' => ['auth', "reception"]], function () {
        Route::controller(ReceptionController::class)->prefix('reception')->name("reception.")->group(function(){
            Route::get("/dashboard", "receptionDashboard")->name("dashboard");
        });
    });
    //</------------------------------- Reception Routes ----------------------------------------/>

});


require __DIR__.'/auth.php';
