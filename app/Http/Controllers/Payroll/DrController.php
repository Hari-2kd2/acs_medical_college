<?php
namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DRController extends Controller
{
    public function index()
    {
        return view('admin.payroll.uploadSalaryDetails.uploadSalaryDetails');
    }

    public function fetch_data(Request $request)
    {
        if ($request->ajax()) {
            if ($request->from_date != '' && $request->to_date != '') {
                $data = DB::table('upload_salary_details')->whereBetween('date', [$request->from_date, $request->to_date])->get();
            } else {
                $data = DB::table('upload_salary_details')->orderBy('date', 'desc')->get();
            }
            // echo json_encode($data);
            return Excel::download((new $data), 'excelname.xlsx');
            dd($data);
        }
    }
}
