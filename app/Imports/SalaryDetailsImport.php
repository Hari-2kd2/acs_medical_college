<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\UploadSalaryDetail;
use Maatwebsite\Excel\Concerns\ToModel;

class SalaryDetailsImport implements ToModel
{
    public function model(array $row)
    {
            dd($row);
        return new UploadSalaryDetail([

            'employee_id'           => $row[0],
            'employee_name'         => $row[1],
            'month_of_salary'       => $row[2],
            'designation'           => $row[3],
            'department'            => $row[4],
            'basic_salary'          => $row[5],
            'arrs'                  => $row[6],
            'total_overtime_amount' => $row[7],
            'ta'                    => $row[8],
            'refund'                => $row[9],
            'tds'                   => $row[10],
            'pf'                    => $row[11],
            'esi'                   => $row[12],
            'e_bill'                => $row[13],
            'trans_charge'          => $row[14],
            'adv'                   => $row[15],
            'acco'                  => $row[16],
            'prof_tax'              => $row[17],
            'total_absence_amount'  => $row[18],
            'total_earning'         => $row[19],
            'total_deduction'       => $row[20],
            'net_salary'            => $row[21],
            'gross_salary'          => $row[22],
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),

        ]);
    }
}
