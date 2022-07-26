<!DOCTYPE html>
<html lang="en">

<head>
    <title>Salary Sheet Report</title>
    <meta charset="utf-8">
</head>
<style>
    table {
        margin: 0 0 40px 0;
        width: 100%;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        display: table;
        border-collapse: collapse;
    }

    .printHead {
        width: 35%;
        margin: 0 auto;
    }

    table,
    td,
    th {
        border: 1px solid black;
    }

    td {
        padding: 5px;
    }

    th {
        padding: 5px;
    }

</style>

<body>
    <div class="printHead">
        @if ($printHead)
            {!! $printHead->description !!}
        @endif
        <p style="margin-left: 42px;margin-top: 10px"><b>Salary Sheet Report</b></p>
    </div>
    <div class="container">
        <b>@lang('common.date') :</b>{{ $date }},<b>@lang('employee.department') : </b>{{ $department_id }}
        <div class="table-responsive">
            <table id="" class="table table-striped table-bordered table-sm" cellspacing="0" width="90%">
                <thead class="tr_header">
                    <tr>
                        <td colspan="8" class="text-center hidden" style="font-size: 14px">ACS Medical
                            College and Hospital, <span>Velappanchavadi,
                                Chennai - 600 077.</span></td>
                    </tr>
                    <tr>
                        <td class="col-md-1" scope="col">S/L</td>
                        <td class="col-md-1" scope="col">Month of Salary</td>
                        <td class="col-md-1" scope="col">Employee Id</td>
                        <td class="col-md-1" scope="col">Employee Name</td>
                        <td class="col-md-1" scope="col">Designation</td>
                        <td class="col-md-1" scope="col">Department</td>
                        <td class="col-md-1" scope="col">Basic Salary</td>
                        <td class="col-md-1" scope="col">Gross Salary</td>
                    </tr>
                </thead>
                <tbody>
                    @if (count($results) > 0)
                        @foreach ($results as $key => $value)
                            @php
                                $month = $value->month_of_salary;
                                $employee_id = $value->employee_id;
                                $basic_salary = $value->basic_salary;
                                $total_overtime_amount = $value->total_overtime_amount;
                                $total_deduction = $value->total_deduction;
                                $gross_salary = $value->gross_salary;
                            @endphp
                            <tr>
                                <td>{{ $results->firstItem() + $key }}</td>
                                <td>{{ $month }}</td>
                                <td>{{ $value->employee_id }}</td>
                                <td>{{ $value->employee_name }}</td>
                                <td>{{ $value->designation }}</td>
                                <td>{{ $value->department }}</td>
                                <td>{{ $value->basic_salary }}</td>
                                <td>{{ $value->gross_salary }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7">@lang('common.no_data_available') !</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
