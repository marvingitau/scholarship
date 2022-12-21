<?php

use App\Models\Admin\FeeSection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Finance\FinanceController;
use App\Http\Controllers\Admin\FeeSectionController;
use App\Http\Controllers\Committee\CReportController;
use App\Http\Controllers\Clerk\AcademicInfoController;
use App\Http\Controllers\Admin\StudyMaterialController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Clerk\ClerkDashboardController;
use App\Http\Controllers\Clerk\BeneficiaryformController;
use App\Http\Controllers\Committee\CFeeSectionController;
use App\Http\Controllers\Committee\CStudyMaterialController;
use App\Http\Controllers\Committee\CommitteeDashboardController;

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
Route::group(['middleware'=>'role:admin'],function () {
    Route::group(['namespace'=>'Admin','prefix'=>'admin'],function () {
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
        Route::get('/import/yearlyfee',[AdminDashboardController::class,'importyearlyfees'])->name('admin.importyearlyfee');
        Route::post('/import/yearlyfee',[AdminDashboardController::class,'fileImport'])->name('admin.saveyearlyfee');

        Route::get('/schoolreport/{id}',[AdminDashboardController::class,'schoolreport'])->name('admin.schoolreport');
        Route::get('/newschoolreport/{id}',[AdminDashboardController::class,'newschoolreport'])->name('admin.newschoolreport');
        Route::post('/postschoolreport',[AdminDashboardController::class,'postschoolreport'])->name('admin.postschoolreport');
        Route::get('/viewschoolreport/{id}',[AdminDashboardController::class,'viewschoolreport'])->name('admin.viewschoolreport');
        Route::get('/dowloadschoolslip/{id}',[AdminDashboardController::class,'viewschoolslip'])->name('admin.viewschoolslip');

        // Reports
        Route::get('/report',[ReportController::class,'index'])->name('admin.selectreport');
        Route::get('/report/get',[ReportController::class,'viewreport'])->name('admin.postviewreport');
        Route::get('/report/excel',[ReportController::class,'excelreport'])->name('admin.getexcelreport');
        Route::get('/active/beneficiaries',[ReportController::class,'filteractivebene'])->name('admin.filteractivebeneficiaries');
        Route::get('/archived/beneficiaries',[ReportController::class,'filterarchived'])->name('admin.filterarchived');
        Route::get('/active/beneficiaries/get',[ReportController::class,'filteractiveget'])->name('admin.getactivebeneficiaries');
        Route::get('/active/beneficiaries/fee',[ReportController::class,'getfeeactive'])->name('admin.feeactivebeneficiaries');


        //Additional Information
        Route::get('/additionalinfo/{id}',[AdminDashboardController::class,'additionalinfo'])->name('admin.additionalinfo');
        Route::post('/updateadditionalinfo/{id}',[AdminDashboardController::class,'updateadditionalinfo'])->name('admin.updateadditionalinfo');
        Route::get('/newschoolinfo/{id}',[AdminDashboardController::class,'newschoolinfo'])->name('admin.newschoolinfo');
        Route::post('/postnewschoolinfo',[AdminDashboardController::class,'postnewschoolinfo'])->name('admin.postnewschoolinfo');
        Route::get('/getschoolinfo/{id}',[AdminDashboardController::class,'getschoolinfo'])->name('admin.getschoolinfo');
        Route::post('/updatenewschoolinfo',[AdminDashboardController::class,'updatenewschoolinfo'])->name('admin.updatenewschoolinfo');
        Route::get('/deleteschoolinfo/{id}',[AdminDashboardController::class,'delschoolinfo'])->name('admin.deleteschoolinfo');

        Route::get('/newtransfer/{id}',[AdminDashboardController::class,'newtransfer'])->name('admin.newtransfer');
        Route::post('/postnewtransfer',[AdminDashboardController::class,'postnewtransfer'])->name('admin.postnewtransfer');
        Route::get('/gettransfer/{id}',[AdminDashboardController::class,'gettransfer'])->name('admin.gettransfer');
        Route::post('/updatenewtransfer',[AdminDashboardController::class,'updatenewtransfer'])->name('admin.updatenewtransfer');
        Route::get('/deletetransfer/{id}',[AdminDashboardController::class,'deltransfer'])->name('admin.deletetransfer');


        //Study Materials
        Route::get('/studymaterials',[StudyMaterialController::class,'index'])->name('admin.studymaterials');
        Route::get('/create/studymaterial',[StudyMaterialController::class,'create'])->name('admin.createstudymaterial');
        Route::post('/upload/studymaterial',[StudyMaterialController::class,'fileUpload'])->name('admin.uploadstudymaterial');
        Route::get('view/studymaterial/{id}',[StudyMaterialController::class,'download'])->name('admin.viewstudymaterial');
        Route::get('delete/studymaterial/{id}',[StudyMaterialController::class,'deltefile'])->name('admin.deletestudymaterial');

        Route::get('/mailedstudymaterials',[StudyMaterialController::class,'mailedmaterials'])->name('admin.mailedstudymaterials');
        Route::get('/mailstudymaterials/{id}',[StudyMaterialController::class,'mailmaterials'])->name('admin.mailmaterials');

        //Fee Payment
        Route::get('/bankstatement',[FeeSectionController::class,'index'])->name('admin.bankstatement');
        Route::get('get/bankstatement',[FeeSectionController::class,'getfeeexcel'])->name('admin.getbankstatement');
        Route::get('feepayment',[FeeSectionController::class,'feepaymentview'])->name('admin.feepayment');
        Route::post('import/feepayment',[FeeSectionController::class,'importfeepayment'])->name('admin.importfeepayment');


        //Communications
        Route::get('/contacts',[ReportController::class,'contacts'])->name('admin.contacts');
        Route::get('/excelcontacts',[ReportController::class,'contactxcel'])->name('admin.excelcontacts');


        //Ongoing Beneficiaries
        Route::get('/ongoing-beneficiary',[AdminDashboardController::class,'ongoingbeneficiary'])->name('admin.ongoingbeneficiary');
        Route::get('/beneficiary-fee/{id}',[AdminDashboardController::class,'ongoingfeeview'])->name('admin.ongoingfeeview');
        Route::post('/post/beneficiary-fee',[AdminDashboardController::class,'postongoingfeeview'])->name('admin.postongoingfeeview');
        Route::get('/ongoing-beneficiary-excel',[AdminDashboardController::class,'ongoingbeneficiaryexcel'])->name('admin.excelongoingbeneficiary');



    });
}); 

//Committee
Route::group(['middleware'=>'role:committee'],function () {
    Route::group(['namespace'=>'Committee','prefix'=>'committee'],function () {
        Route::get('/', [CommitteeDashboardController::class,'index'])->name('committee.dashboard');
        Route::get('/stats', [ClerkDashboardController::class,'stats'])->name('committee.stats');
        Route::get('/application-list',[CommitteeDashboardController::class,'applicationlist'])->name('committee.applicationlist');
        Route::get('/applicant/{id}',[CommitteeDashboardController::class,'applicant'])->name('committee.selectapplicant');
        Route::post('/approve/applicant',[CommitteeDashboardController::class,'approve'])->name('committee.approveapplicant');
        Route::post('/reject/applicant',[CommitteeDashboardController::class,'reject'])->name('committee.rejectapplicant');
        //Beneficiaries
        Route::get('/approved/applicants',[CommitteeDashboardController::class,'approvedbeneficiaries'])->name('committee.approvedbeneficiaries');
        Route::get('/archive/applicant/{id}',[CommitteeDashboardController::class,'archivebeneficiaries'])->name('committee.archivebeneficiary');
        Route::get('/unarchive/applicant/{id}',[CommitteeDashboardController::class,'unarchivebeneficiaries'])->name('committee.unarchivebeneficiary');
        Route::get('/archived/applicants',[CommitteeDashboardController::class,'archivedbeneficiaries'])->name('committee.archivedbeneficiaries');
        Route::get('/beneficiary/{id}',[CommitteeDashboardController::class,'selectbeneficiary'])->name('committee.selectbeneficiary');
        Route::get('/rejected/applicants',[CommitteeDashboardController::class,'rejectedapplicants'])->name('committee.rejectedapplicants');
        Route::get('/unrejected/applicant/{id}',[CommitteeDashboardController::class,'unrejectedapplicants'])->name('committee.unrejectedapplicants');
        //Beneficiaries Actions
        Route::get('/beneficiary/disciplinary/{id}',[CommitteeDashboardController::class,'beneficiarydisciplinary'])->name('committee.beneficiarydisciplinary');
        Route::get('/beneficiary/fee/{id}',[CommitteeDashboardController::class,'beneficiaryfee'])->name('committee.beneficiaryfee');
        Route::get('/beneficiary/mentorship/{id}',[CommitteeDashboardController::class,'beneficiarymentorship'])->name('committee.beneficiarymentorship');
        
        Route::get('/new/disciplinary/{id}',[CommitteeDashboardController::class,'newdisciplinary'])->name('committee.newdisciplinary');
        Route::post('/new/disciplinary',[CommitteeDashboardController::class,'postnewdisciplinary'])->name('committee.postnewdisciplinary');
        Route::get('/view/disciplinary/{id}',[CommitteeDashboardController::class,'viewdisciplinary'])->name('committee.viewdisciplinary');

        Route::get('/new/mentor/{id}',[CommitteeDashboardController::class,'newmentor'])->name('committee.newmentor');
        Route::post('/new/mentor',[CommitteeDashboardController::class,'postnewmentor'])->name('committee.postnewmentor');
        Route::get('/view/mentor/{id}',[CommitteeDashboardController::class,'viewmentor'])->name('committee.viewmentor');

        Route::get('/new/fee/{id}',[CommitteeDashboardController::class,'newfee'])->name('committee.newfee');
        Route::post('/new/fee',[CommitteeDashboardController::class,'postnewfee'])->name('committee.postnewfee');
        Route::get('/view/fee/{id}',[CommitteeDashboardController::class,'viewfee'])->name('committee.viewfee');

        Route::get('/user/list',[CommitteeDashboardController::class,'userlist'])->name('committee.userlist');
        Route::get('/new/user',[CommitteeDashboardController::class,'newuser'])->name('committee.newuser');
        Route::post('/new/user',[CommitteeDashboardController::class,'createnewuser'])->name('committee.postnewuser');

        //Fees
        Route::get('/academicyears',[CommitteeDashboardController::class,'academicyears'])->name('committee.academicyears');
        Route::get('/academicyearform',[CommitteeDashboardController::class,'academicyearview'])->name('committee.academicyearform');
        Route::post('/academicyear',[CommitteeDashboardController::class,'academicyear'])->name('committee.academicyear');
        Route::get('/academicyearsdata',[CommitteeDashboardController::class,'academicyeardata'])->name('committee.academicyearsdata');

        Route::get('/yearlyfee',[CommitteeDashboardController::class,'yearlyfees'])->name('committee.yearlyfee');
        Route::get('/yearlyfeedata',[CommitteeDashboardController::class,'yearlyfeesdata'])->name('committee.yearlyfeedata');
        Route::get('/create/yearlyfee',[CommitteeDashboardController::class,'createyearlyfees'])->name('committee.createyearlyfee');
        Route::post('/post/yearlyfee',[CommitteeDashboardController::class,'postyearlyfees'])->name('committee.postyearlyfee');
        Route::get('/view/yearlyfee/{id}',[CommitteeDashboardController::class,'viewyearlyfees'])->name('committee.viewyearlyfee');
        Route::get('/delete/yearlyfee/{id}',[CommitteeDashboardController::class,'deleteyearlyfees'])->name('committee.deleteyearlyfee');
        Route::get('/download/yearlyfee',[CommitteeDashboardController::class,'downloadyearlyfees'])->name('committee.downloadyearlyfee');
        Route::get('/import/yearlyfee',[CommitteeDashboardController::class,'importyearlyfees'])->name('committee.importyearlyfee');
        Route::post('/import/yearlyfee',[CommitteeDashboardController::class,'fileImport'])->name('committee.saveyearlyfee');

        Route::get('/schoolreport/{id}',[CommitteeDashboardController::class,'schoolreport'])->name('committee.schoolreport');
        Route::get('/newschoolreport/{id}',[CommitteeDashboardController::class,'newschoolreport'])->name('committee.newschoolreport');
        Route::post('/postschoolreport',[CommitteeDashboardController::class,'postschoolreport'])->name('committee.postschoolreport');
        Route::get('/viewschoolreport/{id}',[CommitteeDashboardController::class,'viewschoolreport'])->name('committee.viewschoolreport');
        Route::get('/dowloadschoolslip/{id}',[CommitteeDashboardController::class,'viewschoolslip'])->name('committee.viewschoolslip');

        // Reports
        Route::get('/report',[CReportController::class,'index'])->name('committee.selectreport');
        Route::get('/report/get',[CReportController::class,'viewreport'])->name('committee.postviewreport');
        Route::get('/report/excel',[CReportController::class,'excelreport'])->name('committee.getexcelreport');
        Route::get('/active/beneficiaries',[CReportController::class,'filteractivebene'])->name('committee.filteractivebeneficiaries');
        Route::get('/archived/beneficiaries',[CReportController::class,'filterarchived'])->name('committee.filterarchived');
        Route::get('/active/beneficiaries/get',[CReportController::class,'filteractiveget'])->name('committee.getactivebeneficiaries');
        Route::get('/active/beneficiaries/fee',[CReportController::class,'getfeeactive'])->name('committee.feeactivebeneficiaries');


        //Additional Information
        Route::get('/additionalinfo/{id}',[CommitteeDashboardController::class,'additionalinfo'])->name('committee.additionalinfo');
        Route::post('/updateadditionalinfo/{id}',[CommitteeDashboardController::class,'updateadditionalinfo'])->name('committee.updateadditionalinfo');
        Route::get('/newschoolinfo/{id}',[CommitteeDashboardController::class,'newschoolinfo'])->name('committee.newschoolinfo');
        Route::post('/postnewschoolinfo',[CommitteeDashboardController::class,'postnewschoolinfo'])->name('committee.postnewschoolinfo');
        Route::get('/getschoolinfo/{id}',[CommitteeDashboardController::class,'getschoolinfo'])->name('committee.getschoolinfo');
        Route::post('/updatenewschoolinfo',[CommitteeDashboardController::class,'updatenewschoolinfo'])->name('committee.updatenewschoolinfo');
        Route::get('/deleteschoolinfo/{id}',[CommitteeDashboardController::class,'delschoolinfo'])->name('committee.deleteschoolinfo');

        Route::get('/newtransfer/{id}',[CommitteeDashboardController::class,'newtransfer'])->name('committee.newtransfer');
        Route::post('/postnewtransfer',[CommitteeDashboardController::class,'postnewtransfer'])->name('committee.postnewtransfer');
        Route::get('/gettransfer/{id}',[CommitteeDashboardController::class,'gettransfer'])->name('committee.gettransfer');
        Route::post('/updatenewtransfer',[CommitteeDashboardController::class,'updatenewtransfer'])->name('committee.updatenewtransfer');
        Route::get('/deletetransfer/{id}',[CommitteeDashboardController::class,'deltransfer'])->name('committee.deletetransfer');


        //Study Materials
        Route::get('/studymaterials',[CStudyMaterialController::class,'index'])->name('committee.studymaterials');
        Route::get('/create/studymaterial',[CStudyMaterialController::class,'create'])->name('committee.createstudymaterial');
        Route::post('/upload/studymaterial',[CStudyMaterialController::class,'fileUpload'])->name('committee.uploadstudymaterial');
        Route::get('view/studymaterial/{id}',[CStudyMaterialController::class,'download'])->name('committee.viewstudymaterial');
        Route::get('delete/studymaterial/{id}',[CStudyMaterialController::class,'deltefile'])->name('committee.deletestudymaterial');

        Route::get('/mailedstudymaterials',[CStudyMaterialController::class,'mailedmaterials'])->name('committee.mailedstudymaterials');
        Route::get('/mailstudymaterials/{id}',[CStudyMaterialController::class,'mailmaterials'])->name('committee.mailmaterials');

        //Fee Payment
        Route::get('/bankstatement',[CFeeSectionController::class,'index'])->name('committee.bankstatement');
        Route::get('get/bankstatement',[CFeeSectionController::class,'getfeeexcel'])->name('committee.getbankstatement');
        Route::get('feepayment',[CFeeSectionController::class,'feepaymentview'])->name('committee.feepayment');
        Route::post('import/feepayment',[CFeeSectionController::class,'importfeepayment'])->name('committee.importfeepayment');


        //Communications
        Route::get('/contacts',[CReportController::class,'contacts'])->name('committee.contacts');
        Route::get('/excelcontacts',[CReportController::class,'contactxcel'])->name('committee.excelcontacts');


        //Ongoing Beneficiaries
        Route::get('/ongoing-beneficiary',[CommitteeDashboardController::class,'ongoingbeneficiary'])->name('committee.ongoingbeneficiary');
        Route::get('/beneficiary-fee/{id}',[CommitteeDashboardController::class,'ongoingfeeview'])->name('committee.ongoingfeeview');
        Route::post('/post/beneficiary-fee',[CommitteeDashboardController::class,'postongoingfeeview'])->name('committee.postongoingfeeview');
        Route::get('/ongoing-beneficiary-excel',[CommitteeDashboardController::class,'ongoingbeneficiaryexcel'])->name('committee.excelongoingbeneficiary');


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
        Route::get('/edit/application/{id}',[BeneficiaryformController::class,'editapplication'])->name('clerk.editapplication');
        Route::post('/update/application',[BeneficiaryformController::class,'updatetheologyform'])->name('clerk.updatetheologyform');
        Route::post('/update/specialapplication',[BeneficiaryformController::class,'updatespecialform'])->name('clerk.updatespecialform');
        Route::post('/update/tertiaryapplication',[BeneficiaryformController::class,'updatetertiaryform'])->name('clerk.updatetertiaryform');
        //Post Beneficiary form :- Personal Details
        Route::post('/personal-details',[BeneficiaryformController::class,'store'])->name('clerk.storepersonaldetail'); //Secondary and tertiary
        Route::post('/special-personal-details',[BeneficiaryformController::class,'storeSpecial'])->name('clerk.storespecialdetail');
        Route::post('/theology-personal-details',[BeneficiaryformController::class,'storeTheology'])->name('clerk.theostorepersonaldetail');
        // Route::post('/academic-details',[AcademicInfoController::class,'store'])->name('clerk.storeacademicdetail');
        Route::get('/tertiary-application',[BeneficiaryformController::class,'tertiary'])->name('clerk.tertiaryapplication');
        Route::get('/theology-application',[BeneficiaryformController::class,'theology'])->name('clerk.theologyapplication');
        Route::get('/special-application',[BeneficiaryformController::class,'special'])->name('clerk.specialapplication');

        //Ongoing Beneficiaries
        Route::get('/ongoing-beneficiary',[BeneficiaryformController::class,'ongoingbeneficiary'])->name('clerk.ongoingbeneficiary');
        Route::get('/beneficiary-fee/{id}',[BeneficiaryformController::class,'ongoingfeeview'])->name('clerk.ongoingfeeview');
        Route::post('/post/beneficiary-fee',[BeneficiaryformController::class,'postongoingfeeview'])->name('clerk.postongoingfeeview');
        Route::get('/ongoing-beneficiary-excel',[BeneficiaryformController::class,'ongoingbeneficiaryexcel'])->name('clerk.excelongoingbeneficiary');


    });
});

// Paymaster
Route::group(['middleware'=>'role:finance','prefix'=>'finance'],function(){

    Route::group(['namespace'=>'Finance'],function(){
        Route::get('/', [FinanceController::class,'index'])->name('finance.dashboard');
        Route::get('/feestatement', [FinanceController::class,'yearlyfees'])->name('finance.pendingfee');
        Route::get('/feepayment',[FinanceController::class,'feepaymentview'])->name('finance.feepayment');
        Route::post('/import/feepayment',[FinanceController::class,'importfeepayment'])->name('finance.importfeepayment');
        //Fee History
        Route::get('/export/feehistory',[FinanceController::class,'yealyFeeReport'])->name('finance.exportfeehistory');


        Route::get('/bankstatement',[FinanceController::class,'bankstatementview'])->name('finance.bankstatement');
        Route::get('get/bankstatement',[FinanceController::class,'getfeeexcel'])->name('finance.getbankstatement');

        Route::get('/viewfeestatement/{id}', [FinanceController::class,'viewstatement'])->name('finance.viewpendingfee');
        Route::post('/updatefeeledger', [FinanceController::class,'updatefeeledger'])->name('finance.updatefeeledger');

    });
});
