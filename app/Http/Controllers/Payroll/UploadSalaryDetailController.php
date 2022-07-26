<?php

namespace App\Http\Controllers\Payroll;

use App\Exports\SalaryDetailExport;
use App\Http\Controllers\Controller;
use App\Models\UploadSalaryDetail;
use App\Repositories\PayrollRepository;
use Barryvdh\DomPDF\Facade\PDF as PDF;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class UploadSalaryDetailController extends Controller
{
    protected $_payrollRepository;

    public function __construct(PayrollRepository $payrollRepository)
    {
        $this->payrollRepository = $payrollRepository;
    }
    public function index(Request $request)
    {
        $date  = dateConvertFormtoDB($request->dateField);
        $count = DB::table('upload_salary_details')->where('date', Carbon::today())->count();
        // dd($count);
        $results = DB::table('upload_salary_details')->where('date', Carbon::today())
            ->orderByDesc('id')->simplePaginate($count);
        if (request()->ajax()) {

            $results = DB::table('upload_salary_details')->orderBy('id', 'DESC');

            if ($date != '') {
                $results->where('date', $date);
            }

            $results = $results->simplePaginate($count);

            return View('admin.payroll.uploadSalaryDetails.pagination', compact('results'))->render();
        }

        return view('admin.payroll.uploadSalaryDetails.uploadSalaryDetails', ['results' => $results, 'date' => $request->dateField]);
    }

    public function export(Request $request)
    {
        $salaryReport = UploadSalaryDetail::select('employee_id as Employee Id', 'employee_name as Employee Name', 'department as Department', 'designation as Designation', 'month_of_salary as Salary Month',
            'basic_salary as Basic Salary', 'total_earning as Total Earning', 'total_deduction as Total Deduction', 'gross_salary as Gross Salary', )
            ->orderBy('month_of_salary', 'desc')->get()->toArray();

        $exportFormat = Excel::create('Salary Details', function ($excel) use ($salaryReport) {
            $excel->sheet('Salary Details', function ($sheet) use ($salaryReport) {
                $sheet->fromArray($salaryReport);
            });
        })->download($request->type);

        return $exportFormat;

    }

    public function downloadFile()
    {
        $file_name = 'templates/template1.xlsx';
        $file      = Storage::disk('public')->get($file_name);
        return (new Response($file, 200))
            ->header('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    }

    /**
     *This function loads the customer data from the excel then converts it
     * into an Array that will be imported to Database
     */

    public function import(Request $request)
    {
        $this->validate($request, [
            'select_file' => 'required|mimes:xls,xlsx',
        ]);
        $path = $request->file('select_file')->getRealPath();
        try {
            $spreadsheet = IOFactory::load($path);
            $sheet       = $spreadsheet->getActiveSheet();
            // dd($sheet->toArray());
            $row_limit    = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range    = range(2, $row_limit);
            $column_range = range('W', $column_limit);
            $startcount   = 2;
            $data         = array();

            foreach ($row_range as $key => $row) {
                $employee_id     = $sheet->getCell('A' . $row)->getValue();
                $employee_name   = $sheet->getCell('B' . $row)->getValue();
                $month_of_salary = $sheet->getCell('C' . $row)->getValue();
                $duplicateId     = DB::table('upload_salary_details')->where('month_of_salary', $month_of_salary)->where('employee_id', $employee_id)->first();
                if (!$duplicateId) {
                    // dd($row, $row_range, $row_limit, $column_limit, $sheet->getCell('A' . $row)->getValue(),);
                    $data[] = [
                        'employee_id'           => $sheet->getCell('A' . $row)->getValue(),
                        'employee_name'         => $sheet->getCell('B' . $row)->getValue(),
                        'month_of_salary'       => $sheet->getCell('C' . $row)->getValue(),
                        'designation'           => $sheet->getCell('D' . $row)->getValue(),
                        'department'            => $sheet->getCell('E' . $row)->getValue(),
                        'basic_salary'          => $sheet->getCell('F' . $row)->getValue(),
                        'arrs'                  => $sheet->getCell('G' . $row)->getValue(),
                        'total_overtime_amount' => $sheet->getCell('H' . $row)->getValue(),
                        'ta'                    => $sheet->getCell('I' . $row)->getValue(),
                        'refund'                => $sheet->getCell('J' . $row)->getValue(),
                        'tds'                   => $sheet->getCell('K' . $row)->getValue(),
                        'pf'                    => $sheet->getCell('L' . $row)->getValue(),
                        'esi'                   => $sheet->getCell('M' . $row)->getValue(),
                        'e_bill'                => $sheet->getCell('N' . $row)->getValue(),
                        'trans_charge'          => $sheet->getCell('O' . $row)->getValue(),
                        'adv'                   => $sheet->getCell('P' . $row)->getValue(),
                        'acco'                  => $sheet->getCell('Q' . $row)->getValue(),
                        'prof_tax'              => $sheet->getCell('R' . $row)->getValue(),
                        'total_absence_amount'  => $sheet->getCell('S' . $row)->getValue(),
                        'total_earning'         => $sheet->getCell('T' . $row)->getValue(),
                        'total_deduction'       => $sheet->getCell('U' . $row)->getValue(),
                        'net_salary'            => $sheet->getCell('V' . $row)->getValue(),
                        'gross_salary'          => $sheet->getCell('W' . $row)->getValue(),
                        'date'                  => Carbon::now(),
                        'created_at'            => Carbon::now(),
                        'updated_at'            => Carbon::now(),
                    ];
                    // dd($data);
                    $startcount++;
                } elseif ($duplicateId) {
                    return \back()->with('danger', 'Duplicate entries found for an Employee Name - ' . $duplicateId->employee_name . ', ' . 'Employee_Id - ' . $employee_id . '  On row -' . $key + 2);
                } else {
                    return back()->with('danger', 'Cell-headder / Cell-field should no be empty!, Please Check the File');
                }
            }
            DB::table('upload_salary_details')->insert($data);
        } catch (Exception $e) {
            $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
        return back()->withSuccess('Great! Data has been successfully uploaded.');
    }
    /**
     *This function loads the customer data from the database then converts it
     * into an Array that will be exported to Excel
     */

    public function ExportExcel($customer_data)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');
        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->fromArray($customer_data);
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Customer_ExportedData.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('daily-report');
            // $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }
    /**
     *This function loads the customer data from the database then converts it
     * into an Array that will be exported to Excel
     */
    public function exportData(Request $request)
    {
        $data = DB::table('upload_salary_details')
        // ->where('date', $request->dateField)
            ->get();
        $data_array[] = array("EmployeeName", "MonthOfSalary", "Designation", "Department", "BasicSalary", "TotalEarning", "TotalDeduction", "GrossSalary");
        foreach ($data as $data_item) {
            $data_array[] = array(
                'EmployeeName'   => $data_item->employee_name,
                'MonthOfSalary'  => $data_item->month_of_salary,
                'Designation'    => $data_item->designation,
                'Department'     => $data_item->department,
                'BasicSalary'    => $data_item->basic_salary,
                'TotalEarning'   => $data_item->total_earning,
                'TotalDeduction' => $data_item->total_deduction,
                'GrossSalary'    => $data_item->gross_salary,
            );
        }
        return $this->ExportExcel($data_array);
    }

    public function pusher()
    {
        \view('admin.payroll.print.printPayslip');
    }

    public function fetch_data1(Request $request)
    {
        if ($request->ajax()) {
            if ($request->date != '') {
                $data = DB::table('upload_salary_details')->where('date', $request->date)->get();
            } else {
                $data = DB::table('upload_salary_details')->orderBy('date', 'desc')->get();
            }
            dd($data);
            echo json_encode($data);
        }
    }

    public function fetch_data(Request $request)
    {
        // $from_date=$request->from_date;
        // $to_date = $request->to_date;
        $from_date = $request->dateField;

        return Excel::download(new SalaryDetailExport($from_date), 'excelname.xlsx');
    }

    public function downloadDailyReport(Request $request)
    {
        $results = DB::table('upload_salary_details')->where('date', $request->dateField)->get();
        dd($request->dateField);
        $data = [
            'results'   => $results,
            'dateField' => $request->dateField,
        ];
        $pdf = PDF::loadView('admin.payroll.uploadSalaryDetails.pagination', $data);
        $pdf->setPaper('A4', 'landscape');
        $pageName = "daily-report.pdf";
        return $pdf->download($pageName);
    }

}
