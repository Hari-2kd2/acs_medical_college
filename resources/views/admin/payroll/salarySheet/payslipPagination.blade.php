<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="tr_header ">
            <tr class="tr_header">
                <td>@lang('common.serial')</td>
                <td>@lang('common.month')</td>
                <td>@lang('common.employee_name')</td>
                <td>@lang('paygrade.basic_salary')</td>
                <td>@lang('paygrade.gross_salary')</td>
                <td>Download PDF</td>
                <td>Print</td>
            </tr>
        </thead>
        <tbody>
            @if (count($results) > 0)
                {!! $sl = null !!}
                @foreach ($results as $key => $value)
                    <tr>
                        <td style="width: 100px;">{!! ++$sl !!}</td>
                        <td>
                            @php
                                $monthAndYear = explode('-', $value->month_of_salary);

                                $month = $monthAndYear[1];
                                $dateObj = DateTime::createFromFormat('!m', $month);
                                $monthName = $dateObj->format('F');
                                $year = $monthAndYear[0];

                                $monthAndYearName = $monthName . ' ' . $year;
                                echo $monthAndYearName;
                            @endphp
                        </td>
                        <td>
                            @if (isset($value->employee_name))
                                {!! $value->employee_name !!}
                            @endif
                            @if (isset($value->department))
                                <span style="margin: 8px"></span>
                                <span class="text-muted">@lang('employee.department') :
                                    {{ $value->department }}</span>
                            @endif

                        </td>
                        <td>{!! $value->basic_salary !!}</td>
                        <td>{!! $value->gross_salary !!}</td>
                        <td style="width: 220px">
                            <a href="{{ url('generateSalarySheet/generatePayslip', $value->id) }}"
                                target="_blank">
                                {{-- <button
                                    class="btn btn-success  waves-effect waves-light"><span>@lang('salary_sheet.generate_payslip')</span>
                                </button> --}}
                                <span class="label label-success waves-effect waves-light"
                                    style="padding: 8px">@lang('salary_sheet.generate_payslip')</span>
                            </a>
                        </td>
                        <td>
                            <a href="{{ url('generateSalarySheet/printPayslip', $value->id) }}"
                                target="_blank">
                                {{-- <button
                                    class="btn btn-success  waves-effect waves-light"><span>Print</span>
                                </button> --}}
                                <span class="label label-success waves-effect waves-light"
                                    style="padding: 8px">Print</span>
                            </a>
                        </td>

                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="10">@lang('common.no_data_available') !</td>
                </tr>
            @endif
        </tbody>
    </table>
    @if (count($results) > 0)
        <div class="text-center">
            {{ $results->links() }}
        </div>
    @endif
</div>
