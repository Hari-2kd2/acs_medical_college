<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\UploadSalaryDetails;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class SalaryImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new UploadSalaryDetails([
                'employee_id'           => $row['Employee_id'],
                'employee_name'         => $row['Employee_name'],
                'month_of_salary'       => $row['month_of_salary'],
                'designation'           => $row['designation'],
                'department'            => $row['department'],
                'basic_salary'          => $row['basic_salary'],
                'arrs'                  => $row['arrs'],
                'total_overtime_amount' => $row['overtime'],
                'ta'                    => $row['ta'],
                'refund'                => $row['refund'],
                'tds'                   => $row['tds'],
                'pf'                    => $row['pf'],
                'esi'                   => $row['esi'],
                'e_bill'                => $row['e_bill'],
                'trans_charge'          => $row['trans_charge'],
                'adv'                   => $row['adv'],
                'acco'                  => $row['acco'],
                'prof_tax'              => $row['prof_tax'],
                'total_absence_amount'  => $row['lop'],
                'total_earning'         => $row['total_earning'],
                'total_deduction'       => $row['total_deduction'],
                'net_salary'            => $row['net_salary'],
                'gross_salary'          => $row['gross_salary'],
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ]);
    }
    public function headingRow(): int
    {
        return 2;
    }
}
