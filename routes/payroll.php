<?php

use App\Http\Controllers\Payroll\PayslipController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['preventbackbutton', 'auth']], function () {

    Route::group(['prefix' => 'generateSalarySheet'], function () {
        Route::get('/generatePayslip/{id}', 'Payroll\GenerateSalarySheet@generatePayslip');
        Route::get('/employeePayslip', 'Payroll\PayslipController@index');
        Route::get('/pusher', 'Payroll\PayslipController@pusher');
        Route::get('/printPayslip/{id}', 'Payroll\PayslipController@printPayslip');
        Route::get('/monthSalary', ['as' => 'generateSalarySheet.monthSalary', 'uses' => 'Payroll\GenerateSalarySheet@monthSalary']);
    });

    Route::get('downloadPayslip', ['as' => 'downloadPayslip.payslip', 'uses' => 'Payroll\GenerateSalarySheet@payslip']);
    Route::get('downloadPayslip/generatePayslip/{id}', 'Payroll\GenerateSalarySheet@generatePayslip');


    Route::get('downloadPayslip/{id}', 'Payroll\GenerateSalarySheet@downloadPayslip');
    Route::get('downloadMyPayroll', 'Payroll\GenerateSalarySheet@downloadMyPayroll');


    Route::group(['prefix' => 'uploadSalaryDetails'], function () {
        Route::any('/', ['as' => 'uploadSalaryDetails.uploadSalaryDetails', 'uses' => 'Payroll\UploadSalaryDetailController@index']);
        // Route::post('/', ['as' => 'uploadSalaryDetails.uploadSalaryDetails', 'uses' => 'Payroll\UploadSalaryDetailController@index']);
        Route::post('/import', ['as' => 'uploadSalaryDetails.import', 'uses' => 'Payroll\UploadSalaryDetailController@import']);
        Route::get('/export/{type}', ['as' => 'uploadSalaryDetails.export', 'uses' => 'Payroll\UploadSalaryDetailController@export']);
        Route::get('downloadSalaryDetails/{month}', 'Payroll\UploadSalaryDetailController@SalaryDetails');
        Route::get('downloadReport/{date}', 'Payroll\UploadSalaryDetailController@downloadDailyReport');
        // Route::get('/downloadReport', 'Payroll\UploadSalaryDetailController@downloadDailyReport');
        Route::get('/downloadReport', ['as' => 'uploadSalaryDetails.downloadReport', 'uses' => 'Payroll\UploadSalaryDetailController@downloadDailyReport']);
        Route::get('/downloadFile', ['as' => 'uploadSalaryDetails.downloadFile', 'uses' => 'Payroll\UploadSalaryDetailController@downloadFile']);
    });

    // Route::get('downloadReport', ['as' => 'uploadSalaryDetails.downloadReport', 'uses' => 'Payroll\UploadSalaryDetailController@downloadDailyReport']);
    // Route::post('downloadReport', ['as' => 'uploadSalaryDetails.downloadReport', 'uses' => 'Payroll\UploadSalaryDetailController@downloadDailyReport']);
});
