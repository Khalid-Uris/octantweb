<?php

use App\Http\Controllers\AddLoanController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\BorrowerController;
use App\Http\Controllers\CreditUnionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoanTypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

// Route::view('master', 'admin.master');
// Route::view('/borrower/show', 'admin.borrower.showBorrower');
// Route::view('/borrower/add', 'admin.borrower.addBorrower')->name('add');
// Route::view('/borrower/edit', 'admin.borrower.editBorrower');

// Route::view('/loanType/show', 'admin.loanType.showLoanType');
// Route::view('/loanType/add', 'admin.loanType.addLoanType');
// Route::view('/loanType/edit', 'admin.loanType.editLoanType');

// Route::view('/creditUnion/show', 'admin.creditUnion.showCreditUnion');
// Route::view('/creditUnion/add', 'admin.creditUnion.addCreditUnion');
// Route::view('/creditUnion/edit', 'admin.creditUnion.editCreditUnion');

// Route::view('/user/show', 'admin.user.showuser');
// Route::view('/user/add', 'admin.user.addUser');
// Route::view('/user/edit', 'admin.user.editUser');

// Route::view('/archives/show', 'admin.archives.showArchives');

Route::view('/accountSetting/account', 'admin.accountSetting.account');

// Route::view('/addLoan/show', 'admin.addLoan.showLoan');
// Route::view('/addLoan/add', 'admin.addLoan.addLoan');



//Login User
Route::get('login',[UserController::class,'loginView'])->name('user.login');
Route::get('login/check',[UserController::class,'login'])->name('user.loginCheck');
Route::get('logout',[UserController::class,'logout'])->name('user.logout');

Route::middleware(['userMiddleware'])->group(function () {
//Borrower
Route::get('borrowers/add',[BorrowerController::class,'index'])->name('borrowers.index');
Route::post('borrowers/store',[BorrowerController::class,'store'])->name('borrowers.store');
Route::get('borrowers/show',[BorrowerController::class,'show'])->name('borrowers.show');
Route::get('borrowers/edit/{id}',[BorrowerController::class,'edit'])->name('borrowers.edit');
Route::post('borrowers/update/{id}',[BorrowerController::class,'update'])->name('borrowers.update');
Route::get('borrowers/destroy/{id}',[BorrowerController::class,'destroy'])->name('borrowers.destroy');

//Loan Type
Route::get('loan-type/index',[LoanTypeController::class,'index'])->name('loan-type.index');
Route::post('loan-type/store',[LoanTypeController::class,'store'])->name('loan-type.store');
Route::get('loan-type/show',[LoanTypeController::class,'show'])->name('loan-type.show');
Route::get('loan-type/edit/{id}',[LoanTypeController::class,'edit'])->name('loan-type.edit');
Route::post('loan-type/update/{id}',[LoanTypeController::class,'update'])->name('loan-type.update');
Route::get('loan-type/destroy/{id}',[LoanTypeController::class,'destroy'])->name('loan-type.destroy');

//Credit Union
Route::get('credit-union/index',[CreditUnionController::class,'index'])->name('credit-union.index');
Route::post('credit-union/store',[CreditUnionController::class,'store'])->name('credit-union.store');
Route::get('credit-union/show',[CreditUnionController::class,'show'])->name('credit-union.show');
Route::get('credit-union/edit/{id}',[CreditUnionController::class,'edit'])->name('credit-union.edit');
Route::post('credit-union/update/{id}',[CreditUnionController::class,'update'])->name('credit-union.update');
Route::get('credit-union/destroy/{id}',[CreditUnionController::class,'destroy'])->name('credit-union.destroy');



});
//User
Route::get('user/index',[UserController::class,'index'])->name('user.index');
Route::post('user/store',[UserController::class,'store'])->name('user.store');
Route::get('user/show',[UserController::class,'show'])->name('user.show');
Route::get('user/edit/{id}',[UserController::class,'edit'])->name('user.edit');
Route::post('user/update/{id}',[UserController::class,'update'])->name('user.update');
Route::get('user/destroy/{id}',[UserController::class,'destroy'])->name('user.destroy');

//Add Loan
Route::get('loan/index',[AddLoanController::class,'index'])->name('loan.index');
Route::post('loan/store',[AddLoanController::class,'store'])->name('loan.store');
Route::get('loan/show',[AddLoanController::class,'show'])->name('loan.show');
Route::get('loan/edit/{id}',[AddLoanController::class,'edit'])->name('loan.edit');
Route::post('loan/update/{id}',[AddLoanController::class,'update'])->name('loan.update');

Route::get('/export', [AddLoanController::class,'export'])->name('loan.export');
Route::get('/exportIndividual/{loan_id}', [AddLoanController::class,'ExportIndividualIdToCSV'])->name('loan.exportIndividual');
//ExportIndividualIdToCSV

Route::get('loan/updateToStatusArchived/{id}',[AddLoanController::class,'updateToStatusArchived'])->name('loan.updateToStatusArchived');

// Archived
Route::get('loan/archivedLoanShow',[AddLoanController::class,'archivedLoanShow'])->name('loan.archivedLoanShow');
Route::get('loan/updateToStatusPending/{id}',[AddLoanController::class,'updateToStatusPending'])->name('loan.updateToStatusPending');

Route::get('loan/destroy/{id}',[AddLoanController::class,'destroy'])->name('loan.destroy');

//Account Setting
Route::get('setting/editSetting',[UserController::class,'editSetting'])->name('setting.editSetting');
Route::post('setting/storeSetting',[UserController::class,'storeSetting'])->name('setting.storeSetting');
Route::post('setting/settingImage',[UserController::class,'settingImage'])->name('setting.settingImage');
Route::post('setting/settingPassword',[UserController::class,'settingPassword'])->name('setting.settingPassword');


//Dashboard
Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard.index');

//Forget Password
Route::get('forget-password-login', [ForgotPasswordController::class, 'index'])->name('index.login');
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
