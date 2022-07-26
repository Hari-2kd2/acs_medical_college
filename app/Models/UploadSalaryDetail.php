<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UploadSalaryDetail extends Model
{
    protected $table = 'upload_salary_details';
    // protected $primaryKey = 'salary_details_id';

    protected $fillable = [
        'id', 'employee_id','employee_name','month_of_salary',
        'designation', 'department','basic_salary',  'arrs','total_overtime_amount',
         'ta', 'refund','tds', 'pf', 'esi', 'e_bill', 'trans_charge', ' adv', 'acco',
          'prof_tax', 'total_absence_amount', 'total_earning','total_deduction',
          'gross_salary','net_salary',

    ];

    public function employee(){
        return $this->belongsTo(Employee::class,'employee_id');
    }

    public function payGrade(){
        return $this->belongsTo(PayGrade::class,'pay_grade_id');
    }

    public function hourlySalaries(){
        return $this->belongsTo(HourlySalary::class,'hourly_salaries_id');
    }

    public function department(){
        return $this->belongsTo(Department::class,'department_id');
    }

    public function designation(){
        return $this->belongsTo(Designation::class,'designation_id');
    }
}
