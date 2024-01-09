<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


use App\Models\User;
use App\Models\Category;


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


Auth::routes([
    'login' => true,
    'register' => false
]);

Route::get('/load-user', function(){
    if(Auth::check()){
        return Auth::user();
    }
});

Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/registration', [App\Http\Controllers\RegistrationController::class, 'index']);
Route::post('/registration', [App\Http\Controllers\RegistrationController::class, 'store']);

Route::get('/get-user/{id}', [App\Http\Controllers\OpenUserController::class, 'getUser']);

//ADDRESS
Route::get('/load-provinces', [App\Http\Controllers\AddressController::class, 'loadProvinces']);
Route::get('/load-cities', [App\Http\Controllers\AddressController::class, 'loadCities']);
Route::get('/load-barangays', [App\Http\Controllers\AddressController::class, 'loadBarangays']);
Route::get('/load-religions', [App\Http\Controllers\AddressController::class, 'loadReligions']);


Route::get('/load-grade-levels', [App\Http\Controllers\OpenController::class, 'loadGradeLevels']);
Route::get('/load-semesters', [App\Http\Controllers\OpenController::class, 'loadSemesters']);
Route::get('/load-tracks', [App\Http\Controllers\OpenController::class, 'loadTracks']);
Route::get('/load-strands', [App\Http\Controllers\OpenController::class, 'loadStrands']);
Route::get('/load-section', [App\Http\Controllers\OpenController::class, 'loadSection']);
Route::get('/load-other-fees', [App\Http\Controllers\OpenController::class, 'loadOtherFees']);
Route::get('/load-curriculums', [App\Http\Controllers\OpenController::class, 'loadCurriculums']);
Route::get('/load-grade-level-subjects/{gradeLevel}', [App\Http\Controllers\OpenController::class, 'loadGradeLevelSubjects']);

Route::get('/load-subjects-by-semester/{gradeLevel}/{semesterId}', [App\Http\Controllers\OpenController::class, 'loadSubjectsBySemester']);



//open links
Route::get('/load-academic-years', [App\Http\Controllers\OpenController::class, 'loadAcademicYears']);
Route::get('/load-academic-year', [App\Http\Controllers\OpenController::class, 'loadAcademicYear']);

Route::get('/load-open-religions', [App\Http\Controllers\OpenController::class, 'loadReligions']);


//TEACHER ROUTES
Route::middleware(['auth', 'teacher'])->group(function(){

    Route::get('/teacher-home', [App\Http\Controllers\Teacher\TeacherHomeController::class, 'index']);


    Route::get('/my-subjects', [App\Http\Controllers\Teacher\MySubjectController::class, 'index']);
    Route::get('/get-my-subjects', [App\Http\Controllers\Teacher\MySubjectController::class, 'getData']);

    Route::get('/grade-entry', [App\Http\Controllers\Teacher\GradeEntryController::class, 'index']);
    Route::get('/get-my-learners', [App\Http\Controllers\Teacher\GradeEntryController::class, 'getMyLearners']);
    
    Route::post('/save-grade', [App\Http\Controllers\Teacher\GradeEntryController::class, 'store']);
    

});





// -----------------------ADMINISTRATOR-----------------------------------

Route::middleware(['auth', 'admin'])->group(function(){

    Route::get('/admin-dashboard', [App\Http\Controllers\Administrator\AdminDashboardController::class, 'index']);

    Route::resource('/academic-years', App\Http\Controllers\Administrator\AcademicYearController::class);
    Route::get('/get-academic-years', [App\Http\Controllers\Administrator\AcademicYearController::class, 'getAcademicYears']);
    Route::post('/academic-year-active/{id}', [App\Http\Controllers\Administrator\AcademicYearController::class, 'active']);

    Route::resource('/manage-curriculums', App\Http\Controllers\Administrator\CurriculumController::class);
    Route::get('/get-curriculums', [App\Http\Controllers\Administrator\CurriculumController::class, 'getData']);

    Route::get('/manage-curriculum-page/{curId}', [App\Http\Controllers\Administrator\CurriculumPageController::class, 'index']);
    Route::get('/get-grade-levels-shs', [App\Http\Controllers\Administrator\CurriculumPageController::class, 'getGradeLevelSHS']);




    Route::resource('/grade-levels', App\Http\Controllers\Administrator\GradeLevelController::class);
    Route::get('/get-grade-levels', [App\Http\Controllers\Administrator\GradeLevelController::class, 'getData']);

   
    Route::resource('/tracks', App\Http\Controllers\Administrator\TrackController::class);
    Route::get('/get-tracks', [App\Http\Controllers\Administrator\TrackController::class, 'getTracks']);

    
    Route::resource('/teachers', App\Http\Controllers\Administrator\TeacherController::class);
    Route::get('/get-teachers', [App\Http\Controllers\Administrator\TeacherController::class, 'getData']);


    Route::resource('/strands', App\Http\Controllers\Administrator\StrandController::class);
    Route::get('/get-strands', [App\Http\Controllers\Administrator\StrandController::class, 'getStrands']);

    Route::resource('/subjects', App\Http\Controllers\Administrator\SubjectController::class);
    Route::get('/get-subjects', [App\Http\Controllers\Administrator\SubjectController::class, 'getSubjects']);
    Route::get('/get-browse-subjects', [App\Http\Controllers\Administrator\SubjectController::class, 'getBrowseSubjects']);

    Route::resource('/sections', App\Http\Controllers\Administrator\SectionController::class);
    Route::get('/get-sections', [App\Http\Controllers\Administrator\SectionController::class, 'getSections']);

    
    Route::resource('/grade-level-subjects', App\Http\Controllers\Administrator\GradeLevelSubjectController::class);
    Route::get('/get-grade-level-subjects', [App\Http\Controllers\Administrator\GradeLevelSubjectController::class, 'getData']);

    Route::resource('/enrollee', App\Http\Controllers\Administrator\EnrolleeController::class);
    Route::get('/get-enrollees', [App\Http\Controllers\Administrator\EnrolleeController::class, 'getEnrollees']);
    Route::get('/get-browse-enrollees', [App\Http\Controllers\Administrator\EnrolleeController::class, 'getBrowseEnrollees']);
    Route::get('/print-coe/{learnerId}/{ayid}', [App\Http\Controllers\Administrator\EnrolleeController::class, 'coeIndex']);
    Route::get('/get-report-learner/{learnerId}/{ayid}', [App\Http\Controllers\Administrator\EnrolleeController::class, 'getReportLearner']);

    Route::resource('/assign-teacher', App\Http\Controllers\Administrator\AssignTeacherController::class);
    Route::get('/get-enroll-section-subjects', [App\Http\Controllers\Administrator\AssignTeacherController::class, 'getData']);
    Route::get('/load-teacher-lists', [App\Http\Controllers\Administrator\AssignTeacherController::class, 'loadTeacherList']);
    Route::post('/save-teacher', [App\Http\Controllers\Administrator\AssignTeacherController::class, 'saveTeacher']);
    
    
    
    Route::resource('/enrollment', App\Http\Controllers\Administrator\EnrollmentController::class);
  

    Route::resource('/manage-learners', App\Http\Controllers\Administrator\ManageLearnerController::class);
    Route::get('/get-learners', [App\Http\Controllers\Administrator\ManageLearnerController::class, 'getLearners']);
    Route::get('/get-browse-learners', [App\Http\Controllers\Administrator\ManageLearnerController::class, 'getBrowseLearners']);


    Route::resource('/billing-subjects', App\Http\Controllers\Administrator\BillingController::class);
    Route::get('/get-billing-subjects', [App\Http\Controllers\Administrator\BillingController::class, 'getData']);
    Route::get('/get-browse-billings', [App\Http\Controllers\Administrator\BillingController::class, 'getBrowseBillings']);
    
    
    Route::resource('/billing-payment', App\Http\Controllers\Administrator\BillingPaymentController::class);
    Route::get('/get-billing-payment', [App\Http\Controllers\Administrator\BillingPaymentController::class, 'getData']);
    
    Route::get('/payment-history/{learnerId}', [App\Http\Controllers\Administrator\PaymentHistoryController::class, 'index']);
    Route::get('/get-payment-history', [App\Http\Controllers\Administrator\PaymentHistoryController::class, 'getData']);
    

    Route::resource('/other-fees', App\Http\Controllers\Administrator\OtherFeeController::class);
    Route::get('/get-other-fees', [App\Http\Controllers\Administrator\OtherFeeController::class, 'getData']);

    Route::resource('/enrollee-grades', App\Http\Controllers\Administrator\EnrolleeGradeController::class);
    Route::get('/get-enrollee-grades', [App\Http\Controllers\Administrator\EnrolleeGradeController::class, 'getData']);
    Route::get('/get-enrollee-grades-by-learner', [App\Http\Controllers\Administrator\EnrolleeGradeController::class, 'getEnrolleeGradeByLearner']);
    Route::get('/check-already-have-grade/{enrollId}', [App\Http\Controllers\Administrator\EnrolleeGradeController::class, 'checkAlreadyHaveGrade']);
    

    Route::resource('/enrollee-credentials', App\Http\Controllers\Administrator\EnrolleeCredentialController::class);
    Route::get('/get-enrollee-credentials', [App\Http\Controllers\Administrator\EnrolleeCredentialController::class, 'getData']);
    
    Route::resource('/enrollee-credential-list', App\Http\Controllers\Administrator\EnrolleeCredentialListController::class);
    Route::get('/get-enrollee-credential-list', [App\Http\Controllers\Administrator\EnrolleeCredentialListController::class, 'getData']);

    Route::resource('/users', App\Http\Controllers\Administrator\UserController::class);
    Route::get('/get-users', [App\Http\Controllers\Administrator\UserController::class, 'getUsers']);

    Route::post('/user-reset-password/{userid}', [App\Http\Controllers\Administrator\UserController::class, 'resetPassword']);

    Route::get('/report-class-list', [App\Http\Controllers\Administrator\ReportClassListController::class, 'index']);
    Route::get('/get-report-class-list', [App\Http\Controllers\Administrator\ReportClassListController::class, 'getReportClassList']);

    Route::get('/get-report-class-list-by-subject', [App\Http\Controllers\Administrator\ReportClassListController::class, 'getReportClassListBySubject']);

    
    Route::get('/report-enrolment-list', [App\Http\Controllers\Administrator\ReportEnrolmentListController::class, 'index']);
    Route::get('/get-report-enrolment-list', [App\Http\Controllers\Administrator\ReportEnrolmentListController::class, 'getReportEnrolmentList']);

    

});



// -----------------------ADMINSITRATOR-------------------------------------------





Route::get('/session', function(){
    return Session::all();
});



Route::get('/applogout', function(Request $req){
    \Auth::logout();
    $req->session()->invalidate();
    $req->session()->regenerateToken();


});
