<?php

namespace App\Http\Controllers\Payroll;

use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repositories\CommonRepository;
use App\Repositories\PayrollRepository;

class GenerateSalarySheet extends Controller
{

    protected $_commonRepository;
    protected $_payrollRepository;

    public function __construct(CommonRepository $commonRepository, PayrollRepository $payrollRepository)
    {
        $this->commonRepository  = $commonRepository;
        $this->payrollRepository = $payrollRepository;
    }

    public function index(Request $request)
    {
        $results = DB::table('upload_salary_details')->orderBy('id', 'DESC')->simplePaginate(15);
        if (request()->ajax()) {

            $results = DB::table('upload_salary_details')->orderBy('id', 'DESC');

            if ($request->monthField != '') {
                $results->where('month_of_salary', $request->monthField);
            }

            $results = $results->simplePaginate(15);

            return View('admin.payroll.salarySheet.pagination', compact('results'))->render();
        }
        $departmentList = DB::table('upload_salary_details')->select('department')->orderBy('department', 'asc')->groupBy('department')->get();
        return view('admin.payroll.salarySheet.salaryDetails', ['results' => $results, 'departmentList' => $departmentList]);
    }

    public function payslip(Request $request)
    {
        $results = DB::table('upload_salary_details')->orderBy('id', 'DESC')->simplePaginate(15);

        if (request()->ajax()) {

            $results = DB::table('upload_salary_details')->orderBy('id', 'DESC');

            if ($request->monthField != '') {
                $results->where('month_of_salary', $request->monthField);
            }

            $results = $results->simplePaginate(15);

            return View('admin.payroll.salarySheet.pagination', compact('results'))->render();
        }

        $departmentList = DB::table('upload_salary_details')->select('department')->orderBy('department', 'asc')->groupBy('department')->get();
        return view('admin.payroll.salarySheet.downloadPayslip', ['results' => $results, 'departmentList' => $departmentList]);
    }

    public function generatePayslip($id)
    {
        $paySlipId         = $id;
        $paySlipDataFormat = $this->paySlipDataFormat($paySlipId);

        return view('admin.payroll.salarySheet.monthlyPaySlip', $paySlipDataFormat);
    }

    public function paySlipDataFormat($id)
    {
        $salaryDetails = DB::table('upload_salary_details')->where('id', $id)->first();
        return $data   = [
            'salaryDetails' => $salaryDetails,
            'paySlipId'     => $id,
        ];
    }

    public function downloadPayslip($id)
    {
        $payslipId     = $id;
        $salaryDetails = [];
        $salaryDetails = $this->paySlipDataFormat($payslipId);
        $pdf           = PDF::loadView('admin.payroll.salarySheet.monthlyPaySlipPdf', $salaryDetails);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download("payslip.pdf");
    }

    // public function employeePayslip()
    // {
    //     $salaryDetails = [];
    //     $lastMonth     = Carbon::now()->subMonth(1)->format('Y-m');
    //     // dd($lastMonth);

    //     $biometricData = DB::table('print_employee_payslip')->orderByDesc('print_employee_payslip_id')->first();
    //     // dd($biometricData->employee_id);
    //     // $payslipId     = $biometricData->id;

    //     $results = DB::table('upload_salary_details')->join('print_employee_payslip', 'print_employee_payslip.employee_id', '=', 'upload_salary_details.employee_id')
    //         ->orderByDesc('id')->select('upload_salary_details.*')->first();

    //     // ->where('upload_salary_details.id',  $payslipId )
    //     // ->where('print_employee_payslip.created_at', '<=', Carbon::now()->subMinutes(1))
    //     // dd($results);

    //     if ($results != \null) {
    //         $payslipId = $results->id;
    //         // dd($results->id);
    //         $salaryDetails = $this->paySlipDataFormat($payslipId);
    //         $pdf           = PDF::loadView('admin.payroll.salarySheet.printPayslip', $salaryDetails);
    //         $pdf->setPaper('A4', 'landscape');
    //         $data = $pdf->stream("payslip.pdf");
    //         return $data;

    //     }
    //     return redirect('downloadPayslip')->with('error', 'No biomeric data updated recently');

    //     // $pdf->setPaper('A4', 'portrait');
    //     // return $pdf->download("payslip.pdf");

    // }

    public function printPayslip($id)
    {
        $payslipId     = $id;
        $salaryDetails = [];
        $salaryDetails = $this->paySlipDataFormat($payslipId);
        // dd($result);

        $pdf = PDF::loadView('admin.payroll.salarySheet.monthlyPaySlipPdf', $salaryDetails);
        $pdf->setPaper('A4', 'landscape');
        // $pdf->setPaper('A4', 'portrait');
        return $pdf->stream("payslip.pdf");
    }

}
