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




Auth::routes();

Route::group( ['middleware' => 'auth'], function()
{
Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => 'hr_access'], function () {
Route::get('/', 'HomeController@index')->name('home');
});
Route::get('/new-applicant', 'ApplicantController@newApplicant')->name('newApplicant');

Route::get('/employees','EmployeeController@employeeView');
Route::get('/get-active-employees','EmployeeController@activeEmployee');
Route::get('/get-inactive-employees','EmployeeController@inactiveEmployee');
Route::get('/get-probationary-active-employees','EmployeeController@probationaryActive');
Route::get('/get-regular-employees','EmployeeController@regularActive');
Route::get('/get-project-employees','EmployeeController@projectActive');
Route::get('/get-consultant-employees','EmployeeController@consultantActive');

//Active Directory
Route::get('active-directory','ActiveDirectoryController@viewDomainUsers');
Route::get('enable-ad/{accountName}','ActiveDirectoryController@enableAccount');
Route::get('disable-ad/{accountName}','ActiveDirectoryController@disableAccount');
Route::get('reset-password-active-directory/{accountName}','ActiveDirectoryController@resetPassword');
Route::get('get-ou-sub','ActiveDirectoryController@getOu');
Route::get('get-ou-sub-sub','ActiveDirectoryController@getsubOu');
Route::post('add-ADAccount','ActiveDirectoryController@newADAccount');
Route::get('get-account-details','ActiveDirectoryController@getAccountDetails');
Route::get('applicants','ApplicantController@viewApplicants');

//positions-job
Route::post('new-position','JobController@newPosition');
Route::get('positions','JobController@viewPositions');
Route::get('job-description','JobController@viewJobDescription');
Route::post('save-position','JobController@saveEditJob');

//Manpower
Route::post('save-manpower','ManpowerController@saveManpower');
Route::get('/manpower-request','ManpowerController@manpowerRequest');
Route::get('get-manpower','ManpowerController@getManpower');
Route::get('approved-mrf','ManpowerController@approveManpower');
Route::post('verify-manpower/{manpowerId}','ManpowerController@approvedmanpower');


Route::post('proceed-applicant/{applicantID}','ApplicantController@proceedApplicant');
Route::get('for-interview','ApplicantController@forInterview');
Route::get('for-requirements','ApplicantController@forInterview');

Route::get('billings','BillingController@billingView');
Route::get('print-contract/{inventoryId}','ContractController@contractView');
Route::get('billing-pdf','BillingController@billingPdf');
Route::post('upload-pdf-billing','BillingController@uploadPdfBilling');
Route::post('print-all','ContractController@contractallView');
Route::get('accountabilites','AccountabilityController@accountabilites')->name('accountabilities');;
Route::post('upload-billing','BillingController@upload_billing');
Route::get('get-all-history','BillingController@view_billings');


Route::post('proceed-next/{proceedID}','ApplicantController@nextinterview');
Route::post('new-type','AccountabilityController@newType');
Route::post('edit-type','AccountabilityController@editType');
Route::post('transfer-account','AccountabilityController@transferAccount');
Route::post('assign-account','AccountabilityController@assignAccount');
Route::post('remove-account','AccountabilityController@removeAccount');
Route::get('accounts','AccountController@accounts');
Route::post('new-account','AccountController@new_account');
Route::post('deactivate-account','AccountabilityController@deactivate');
//MyPortal
Route::get('headlines','HeadlinesController@index');

//Exams
Route::get('exams','ExamController@exams');
}
);

Route::get('applicant-walk-in','ApplicantController@walkInApplicants');
Route::get('sign-up-walk-in-applicant','ApplicantController@newApplicantWalkin');
Route::get('/get-city','RegionController@getCity');
Route::post('add-walkin-applicant','ApplicantController@saveNewApplicant');
//Applicant
Route::get('/','ApplicantController@applicantApply');
Route::post('/','ApplicantController@saveApplicantApply');
