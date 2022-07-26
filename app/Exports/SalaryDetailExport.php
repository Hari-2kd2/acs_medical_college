<?php

namespace App\Exports;

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalaryDetailExport implements FromQuery, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    use Exportable;

    protected $_from_date;
    protected $_to_date;

    public function __construct($from_date)
    {
        $this->from_date = $from_date;
    }
    // public function __construct($from_date, $to_date)
    // {
    //     $this->from_date = $from_date;
    //     $this->to_date   = $to_date;
    // }

    public function query()
    {
        $data = DB::table('upload_salary_details')
            ->where('date', $this->from_date)
            ->select(
                'date', 'employee_name', 'month_of_salary', 'designation',
                'department', 'total_earning', 'total_deduction', 'gross_salary'
            )
            ->orderBy('id');
        // $data = DB::table('upload_salary_details')
        //     ->whereBetween('date', [$this->from_date, $this->to_date])
        //     ->select(
        //         'date', 'employee_name', 'month_of_salary', 'designation',
        //         'department', 'total_earning', 'total_deduction', 'gross_salary'
        //     )
        //     ->orderBy('id');

        return $data;
    }

    public function headings(): array
    {
        return [
            'date', 'employee_name', 'month_of_salary', 'designation',
            'department', 'total_earning', 'total_deduction', 'gross_salary',
        ];
    }
}
