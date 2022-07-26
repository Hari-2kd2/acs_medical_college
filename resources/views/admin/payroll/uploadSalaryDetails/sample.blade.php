<div class="" style="margin-top: 13px;margin-bottom: 12px;margin-right: 12px;">
    <button class="btn btn-info dailyReport " id="dailyReport" onclick="getDate({{ $date }})">Daily
        Report</button>
</div>
<div class="hidden">
    <div id="filer_table">
        <table class="table table-bordered">
            <thead class="tr_header">
                <tr class="">
                    <td class="col-md-1" scope="col">S/L</td>
                    <td class="col-md-1" scope="col">Date</td>
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
                $date = $value->date;
                $employee_id = $value->employee_id;
                $basic_salary = $value->basic_salary;
                $total_overtime_amount = $value->total_overtime_amount;
                $total_deduction = $value->total_deduction;
                $gross_salary = $value->gross_salary;
                @endphp
                <tr>
                    <td>{{ $results->firstItem() + $key }}</td>
                    <td>{{ $date }}</td>
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
<script>
    // $("#template1").click(function(e) {
    //     window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#btableData').html()));
    //     e.preventDefault();
    // });
    $("#dailyReport").click(function(e) {
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#filer_table').html()));
        e.preventDefault();
    });
</script>
