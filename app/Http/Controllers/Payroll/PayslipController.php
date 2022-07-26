<?php

namespace App\Http\Controllers\Payroll;

use App\Events\PrintPayslip;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PayslipController extends Controller
{

    public function paySlipDataFormat($id)
    {
        $salaryDetails = DB::table('upload_salary_details')->where('id', $id)->first();
        return [
            'salaryDetails' => $salaryDetails,
            'paySlipId'     => $id,
        ];
    }

    public function printPayslip1($id)
    {

        $salaryDetails = [];
        $lastMonth     = Carbon::now()->subMonth(1)->format('Y-m');
        $results       = DB::table('upload_salary_details')->join('print_employee_payslip', 'print_employee_payslip.employee_id', '=', 'upload_salary_details.employee_id')
            ->orderByDesc('id')->select('upload_salary_details.*')->where('upload_salary_details.month_of_salary', $lastMonth)
            ->where('upload_salary_details.employee_id', $id)
            ->whereBetween('print_employee_payslip.created_at', [Carbon::now()->subMinutes(1), Carbon::now()])
            ->first();
        Log::info("PrintP Function From PaySlipController Running");

        if ($results != \null) {
            $payslipId     = $results->id;
            $salaryDetails = $this->paySlipDataFormat($payslipId);
            $pdf           = PDF::loadView('admin.payroll.salarySheet.printPayslip', $salaryDetails);
            $pdf->setPaper('A4', 'portrait');
            // $pdf->setPaper('A4', 'landscape');
            $data = $pdf->stream("payslip.pdf");
            Log::info("printPayslip");
            return $data;
        } else {
            return \redirect('downloadPayslip')->with('error', 'Biometric entries not updated recently');
        }

    }

    public function index1()
    {
        Log::info("index Function From PaySlipController Running");
        $inputArray = ['ACSC1111', 'ACSC1112', 'ACSC1113', 'ACSC1114', 'ACSC1115', 'ACSC1116', 'ACSC1117', 'ACSC1118', 'ACSC1119', 'ACSC1110'];
        $rand       = Arr::random($inputArray);
        // dd($rand);
        $time          = date('Y-m-d H:i:s');
        $biometricData = DB::table('print_employee_payslip')->whereNotNull('employee_id')->orderByDesc('print_employee_payslip_id')->first();
        $insert        = DB::table('print_employee_payslip')->insert(['employee_id' => $rand, 'created_at' => $time, 'updated_at' => $time]);
        $results       = $this->printPayslip($biometricData->employee_id);
        return $results;
        // event(new PrintPayslip('hello world'));
    }

    public function printPayslip($id)
    {
        // dd($id);
        $salaryDetails = [];
        $lastMonth     = Carbon::now()->subMonth(1)->format('Y-m');
        $results       = DB::table('upload_salary_details')
            ->join('acclog', 'acclog.employeeID', '=', 'upload_salary_details.employee_id')
            ->where('upload_salary_details.month_of_salary', $lastMonth)
            ->where('upload_salary_details.employee_id', $id)
        // ->whereBetween('acclog.authDateTime', [Carbon::now()->subMinutes(35), Carbon::now()])
            ->select('upload_salary_details.*')
            ->first();
        // dd($results);
        Log::info("PrintP Function From PaySlipController Running");

        if ($results != \null) {
            $payslipId     = $results->id;
            $salaryDetails = $this->paySlipDataFormat($payslipId);
            $pdf           = PDF::loadView('admin.payroll.salarySheet.printPayslip', $salaryDetails);
            // $pdf->setPaper('A4', 'portrait');
            $pdf->setPaper('A4', 'landscape');
            $data = $pdf->stream("payslip.pdf");
            Log::info("printPayslip");
            return $data;
        } else {
            return \redirect('downloadPayslip')->with('error', 'Biometric entries not updated recently');
        }

    }

    public function index()
    {
        Log::info("index Function From PaySlipController Running");
        $inputArray    = ['00000001', '00000002', '00000002', '00000004', '00000005', '00000006', '00000007', '00000008', '00000009', '00000010', '00000011'];
        $rand          = Arr::random($inputArray);
        $datetime      = date('Y-m-d H:i:s');
        $time          = date('H:i:s');
        $date          = date('Y-m-d');
        $biometricData = DB::table('acclog')->latest('authDateTime')->first();
        // $insert        = DB::table('acclog')->insert(['employee_id' => $rand, 'created_at' => $time, 'updated_at' => $time]);
        $i      = 0;
        $insert = DB::table('acclog')->insert([
            'employeeID'   => 'ACSC2330',
            'authDateTime' => $datetime,
            'authDate'     => $date,
            'authTime'     => $time,
            'direction'    => 'IN',
            'deviceName'   => 'ACS_AC_Accounts',
            'deviceSN'     => 'DS-K1T341AMF20211027V030230ENJ23214816',
            'personName'   => 'Veerappan' . $i++,
            'cardNO'       => '0',
        ]);
        $results = $this->printPayslip($biometricData->employeeID);
        // dd($results);

        return $results;
        // event(new PrintPayslip('hello world'));
    }

}
