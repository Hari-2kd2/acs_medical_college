<div id="btableData">
    <div class="table-responsive">
        <table id="" class="table table-striped table-bordered table-sm" cellspacing="0" width="90%">
            <thead class="tr_header">
                @php
                    $count = '';
                @endphp
                <tr>
                    <td colspan="8" class="text-center hidden" style="font-size: 14px">ACS Medical
                        College and Hospital, <span>Velappanchavadi,
                            Chennai - 600 077.</span><span style="padding-left: 12px">Total Count: {{ count($results)  }} </span></td>
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
                            $count = $results->firstItem() + $key;
                        @endphp
                        <tr>
                            <td>{{ $count }}</td>
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
    $(document).ready(function() {
        $('#dtVerticalScrollExample').DataTable({
            "scrollY": "600px",
            "scrollCollapse": true,
            "pageLength": 100
        });
        $('.dataTables_length').addClass('bs-select');

    });
</script>
