<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePayslip extends Model
{
    use HasFactory;
    
    protected $_table      = 'print_employee_payslip';
    protected $_primaryKey = 'print_employee_payslip_id';

    protected $_fillable = [
        'id', 'employee_id', 'finger_id'];
}
