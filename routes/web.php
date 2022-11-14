<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Clerk\AcademicInfoController;
use App\Http\Controllers\Clerk\ClerkDashboardController;
use App\Http\Controllers\Clerk\BeneficiaryformController;

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
    // return redirect('/login');
    if(Auth::check()){
        $role= auth()->user()->role;
        return redirect('/'.$role);
    }
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Admin
Route::group(['middleware'=>'role:admin','prefix'=>'admin'],function () {
    Route::group(['namespace'=>'Admin'],function () {
        Route::get('/', [AdminDashboardController::class,'index'])->name('admin.dashboard');
        Route::get('/stats', [ClerkDashboardController::class,'stats'])->name('admin.stats');
        Route::get('/application-list',[AdminDashboardController::class,'applicationlist'])->name('admin.applicationlist');
        Route::get('/applicant/{id}',[AdminDashboardController::class,'applicant'])->name('admin.selectapplicant');
        Route::post('/approve/applicant',[AdminDashboardController::class,'approve'])->name('admin.approveapplicant');
        Route::post('/reject/applicant',[AdminDashboardController::class,'reject'])->name('admin.rejectapplicant');
        //Beneficiaries
        Route::get('/approved/applicants',[AdminDashboardController::class,'approvedbeneficiaries'])->name('admin.approvedbeneficiaries');
        Route::get('/archive/applicant/{id}',[AdminDashboardController::class,'archivebeneficiaries'])->name('admin.archivebeneficiary');
        Route::get('/unarchive/applicant/{id}',[AdminDashboardController::class,'unarchivebeneficiaries'])->name('admin.unarchivebeneficiary');
        Route::get('/archived/applicants',[AdminDashboardController::class,'archivedbeneficiaries'])->name('admin.archivedbeneficiaries');
        Route::get('/beneficiary/{id}',[AdminDashboardController::class,'selectbeneficiary'])->name('admin.selectbeneficiary');
        Route::get('/rejected/applicants',[AdminDashboardController::class,'rejectedapplicants'])->name('admin.rejectedapplicants');
        Route::get('/unrejected/applicant/{id}',[AdminDashboardController::class,'unrejectedapplicants'])->name('admin.unrejectedapplicants');
        //Beneficiaries Actions
        Route::get('/beneficiary/disciplinary/{id}',[AdminDashboardController::class,'beneficiarydisciplinary'])->name('admin.beneficiarydisciplinary');
        Route::get('/beneficiary/fee/{id}',[AdminDashboardController::class,'beneficiaryfee'])->name('admin.beneficiaryfee');
        Route::get('/beneficiary/mentorship/{id}',[AdminDashboardController::class,'beneficiarymentorship'])->name('admin.beneficiarymentorship');
        
        Route::get('/new/disciplinary/{id}',[AdminDashboardController::class,'newdisciplinary'])->name('admin.newdisciplinary');
        Route::post('/new/disciplinary',[AdminDashboardController::class,'postnewdisciplinary'])->name('admin.postnewdisciplinary');
        Route::get('/view/disciplinary/{id}',[AdminDashboardController::class,'viewdisciplinary'])->name('admin.viewdisciplinary');

        Route::get('/new/mentor/{id}',[AdminDashboardController::class,'newmentor'])->name('admin.newmentor');
        Route::post('/new/mentor',[AdminDashboardController::class,'postnewmentor'])->name('admin.postnewmentor');
        Route::get('/view/mentor/{id}',[AdminDashboardController::class,'viewmentor'])->name('admin.viewmentor');

        Route::get('/new/fee/{id}',[AdminDashboardController::class,'newfee'])->name('admin.newfee');
        Route::post('/new/fee',[AdminDashboardController::class,'postnewfee'])->name('admin.postnewfee');
        Route::get('/view/fee/{id}',[AdminDashboardController::class,'viewfee'])->name('admin.viewfee');

        Route::get('/user/list',[AdminDashboardController::class,'userlist'])->name('admin.userlist');
        Route::get('/new/user',[AdminDashboardController::class,'newuser'])->name('admin.newuser');
        Route::post('/new/user',[AdminDashboardController::class,'createnewuser'])->name('admin.postnewuser');

        //Fees
        Route::get('/academicyears',[AdminDashboardController::class,'academicyears'])->name('admin.academicyears');
        Route::get('/academicyearform',[AdminDashboardController::class,'academicyearview'])->name('admin.academicyearform');
        Route::post('/academicyear',[AdminDashboardController::class,'academicyear'])->name('admin.academicyear');
        Route::get('/academicyearsdata',[AdminDashboardController::class,'academicyeardata'])->name('admin.academicyearsdata');

        Route::get('/yearlyfee',[AdminDashboardController::class,'yearlyfees'])->name('admin.yearlyfee');
        Route::get('/yearlyfeedata',[AdminDashboardController::class,'yearlyfeesdata'])->name('admin.yearlyfeedata');
        Route::get('/create/yearlyfee',[AdminDashboardController::class,'createyearlyfees'])->name('admin.createyearlyfee');
        Route::post('/post/yearlyfee',[AdminDashboardController::class,'postyearlyfees'])->name('admin.postyearlyfee');
        Route::get('/view/yearlyfee/{id}',[AdminDashboardController::class,'viewyearlyfees'])->name('admin.viewyearlyfee');
        Route::get('/delete/yearlyfee/{id}',[AdminDashboardController::class,'deleteyearlyfees'])->name('admin.deleteyearlyfee');
        Route::get('/download/yearlyfee',[AdminDashboardController::class,'downloadyearlyfees'])->name('admin.downloadyearlyfee');



    });
}); 

// Clerk
Route::group(['middleware'=>'role:clerk','prefix'=>'clerk'],function(){

    Route::group(['namespace'=>'Clerk'],function(){
        Route::get('/', [ClerkDashboardController::class,'index'])->name('clerk.dashboard');
        //Archive beneficiary

        Route::get('/stats', [ClerkDashboardController::class,'stats'])->name('clerk.stats');
        // Beneficiary form urls
        Route::get('/new-application',[BeneficiaryformController::class,'index'])->name('clerk.newapplication');
        Route::get('/application-list',[BeneficiaryformController::class,'applicationlist'])->name('clerk.applicationlist');
        //Post Beneficiary form :- Personal Details
        Route::post('/personal-details',[BeneficiaryformController::class,'store'])->name('clerk.storepersonaldetail');
        // Route::post('/academic-details',[AcademicInfoController::class,'store'])->name('clerk.storeacademicdetail');

    });
});

