<?php

namespace App\Console\Commands;

use Illuminate\Http\Request;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Payroll\PayslipController;

class Payslip extends Command
{
    public function __construct()
    {
        parent::__construct();
    }
    protected $name = "employee-payslip";

    protected $_signature = 'employee:payslip';
    // protected $_signature = 'employee:payslip {specific-name} {--namespace=}';

    protected $_description = 'To Print Employee payslip';

    public function handle()
    {
        Log::info("Command Running");
        $controller = new PayslipController();
        $controller->index();

    }
}
