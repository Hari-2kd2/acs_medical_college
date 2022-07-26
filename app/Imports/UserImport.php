<?php

namespace App\Imports;

use App\Models\UploadPayroll;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserImport implements ToModel, WithHeadingRow
{

    use Importable;
    public function model(array $row)
    {
        return new UploadPayroll([
            'employee_name'   => 'employee_name',
            'employee_id'     => \rand(2, 5),
            'month_of_salary' => '2022-01',
            'designation'     => 'as',
            'department'      => 'as',
            'created_at'      => Carbon::now(),
            'updated_at'      => Carbon::now(),
        ]);

        // dd($row);
        // return new User([
        //     'role_id'    => $row['role'],
        //     'user_name'  => $row['name'],
        //     'password'   => 'demo1234',
        //     'created_by' => 1,
        //     'created_at' => Carbon::now(),
        //     'updated_by' => 1,
        //     'updated_at' => Carbon::now(),
        // ]);
        // dd($row);

        // return new UploadSalaryDetail([

        //     'employee_name'         => $row['employee_name'],
        //     'employee_id'           => $row['employee_id'],
        //     'month_of_salary'       => $row['month_of_salary'],
        //     'designation'           => $row['designation'],
        //     'department'            => $row['department'],
        //     'basic_salary'          => $row['basic_salary'],
        //     'arrs'                  => $row['arrs'],
        //     'total_overtime_amount' => $row['total_overtime_amount'],
        //     'ta'                    => $row['ta'],
        //     'refund'                => $row['refund'],
        //     'tds'                   => $row['tds'],
        //     'pf'                    => $row['pf'],
        //     'esi'                   => $row['esi'],
        //     'e_bill'                => $row['e_bill'],
        //     'trans_charge'          => $row['trans_charge'],
        //     'adv'                   => $row['adv'],
        //     'acco'                  => $row['acco'],
        //     'prof_tax'              => $row['prof_tax'],
        //     'total_absence_amount'  => $row['total_absence_amount'],
        //     'total_earning'         => $row['total_earning'],
        //     'total_deduction'       => $row['total_deduction'],
        //     'net_salary'            => $row['net_salary'],
        //     'gross_salary'          => $row['gross_salary'],
        //     'created_at'            => Carbon::now(),
        //     'updated_at'            => Carbon::now(),

        // ]);
    }
    public function headingRow(): int
    {
        return 1;
    }
}

// return new User([
//     'role_id'    => $row[0],
//     'user_name'  => $row[1],
//     'password'   => 'demo1234',
//     'created_by' => 1,
//     'created_at' => Carbon::now(),
//     'updated_by' => 1,
//     'updated_at' => Carbon::now(),
// ]);
// dd($row);

// 'employee_id'           => $row[0],
// 'employee_name'         => $row[1],
// 'month_of_salary'       => $row[2],
// 'designation'           => $row[3],
// 'department'            => $row[4],
// 'basic_salary'          => $row[5],
// 'arrs'                  => $row[6],
// 'total_overtime_amount' => $row[7],
// 'ta'                    => $row[8],
// 'refund'                => $row[9],
// 'tds'                   => $row[10],
// 'pf'                    => $row[11],
// 'esi'                   => $row[12],
// 'e_bill'                => $row[13],
// 'trans_charge'          => $row[14],
// 'adv'                   => $row[15],
// 'acco'                  => $row[16],
// 'prof_tax'              => $row[17],
// 'total_absence_amount'  => $row[18],
// 'total_earning'         => $row[19],
// 'total_deduction'       => $row[20],
// 'net_salary'            => $row[21],
// 'gross_salary'          => $row[22],
// 'created_at'            => Carbon::now(),
// 'updated_at'            => Carbon::now(),
