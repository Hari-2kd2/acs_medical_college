<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{

    public function index()
    {
        $totalDepartment   = DB::table('upload_salary_details')->groupBy('department')->pluck('department');
        $totalEmployee     = DB::table('upload_salary_details')->where('month_of_salary', Carbon::now()->format('Y-m'))->count('employee_id');
        $totalEmployees    = DB::table('upload_salary_details')->groupBy('employee_name')->pluck('employee_name')->count();
        $monthlySpending   = DB::table('upload_salary_details')->where('month_of_salary', Carbon::now()->subMonth(1)->format('Y-m'))->sum('gross_salary');
        $PastMonthSpending = DB::table('upload_salary_details')->where('month_of_salary', Carbon::now()->subMonth(2)->format('Y-m'))->sum('gross_salary');
        $monthlyDetails    = DB::table('upload_salary_details')->orderByRaw('employee_id')->paginate(15)->fragment('upload_salary_details');
        // return  $monthlyDetails[0]->id;
        // $monthlyDetails    = DB::table('upload_salary_details')->selectRaw("*")->orderBy('employee_id', 'asc')->groupBy('employee_id')->simplePaginate(15);
        // $monthlyDetails           = DB::table('upload_salary_details')->orderBy('employee_id', 'asc')->get()->groupBy('employee_id');
        // foreach ($results as $key => $detail) {
        // // return ($detail[(int)$key]->employee_id);
        //     $monthlyDetails[$detail[(int)$key]->employee_id] = $results;
        // }
        // return ($monthlyDetails);
        $print_employee_payslip = DB::table('print_employee_payslip')->paginate(10);
        return view('admin.adminhome', ['print_employee_payslip' => $print_employee_payslip, 'totalDepartment' => $totalDepartment, 'totalEmployee' => $totalEmployee, 'totalEmployees' => $totalEmployees, 'monthlySpending' => $monthlySpending, 'monthlyDetails' => $monthlyDetails]);
    }

    public function profile()
    {
        $employeeInfo = User::where('user.user_id', \auth()->user()->user_id)->first();

        return view('admin.user.user.profile', ['employeeInfo' => $employeeInfo]);
    }

    public function mail()
    {

        $user = array(
            'name' => "Learning Laravel",
        );

        Mail::send('emails.mailExample', $user, function ($message) {
            $message->to("kamrultouhidsak@gmail.com");
            $message->subject('E-Mail Example');
        });

        return "Your email has been sent successfully";
    }

}
