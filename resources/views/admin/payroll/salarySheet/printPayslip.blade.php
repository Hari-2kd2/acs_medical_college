<!DOCTYPE html>
<html lang="en">

<head>
    <title>@lang('salary_sheet.employee_payslip')</title>
    <meta charset="utf-8">
    <script src="{!! asset('admin_assets/plugins/bower_components/jquery/dist/jquery.min.js') !!}"></script>
    <link href="{!! asset('admin_assets/plugins/bower_components/toast-master/css/jquery.toast.css') !!}" rel="stylesheet">
</head>
<style>
    table {
        margin: 0 0 36px 0;
        width: 100%;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        display: table;
        border-spacing: 0px;
    }

    table,
    td,
    th {
        border: 0.5px solid rgb(0, 0, 0);
    }

    td {
        padding: 3px;
    }

    th {
        padding: 3px;
    }

    .text-center {
        text-align: center;
    }

    .companyAddress {
        width: 367px;
        margin: 0 auto;
    }

    .container {
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
        width: 95%;
    }

    .row {
        margin-right: -15px;
        margin-left: -15px;
    }

    .col-md-6 {
        width: 49%;
        float: left;
        padding-right: .5%;
        padding-left: .5%;
    }

    .div1 {
        position: relative;
    }

    .div2 {
        position: absolute;
        width: 95%;
        border: 1px solid;
        padding: 6px;
    }

    .col-md-4 {
        width: 33.33333333%;
        float: left;
    }

    .clearFix {
        clear: both;
    }

    .padding {
        margin-bottom: 32px;

    }
</style>

<body>
    <div class="container" id="printTableData">
        <meta http-equiv="refresh" content="1">
        <div class="row">
            <div class="div2" style="height: 276px; width: 390px; padding-bottom: 12px">
            <div class="clearFix">
                <div class="" style="width: 390px;height:270px">
                    <div class="table-responsive">
                        <div class="row" style="margin-top: -24px;margin-bottom: -12px;padding-top: 2px">
                            <div align="center">
                                <P><strong>ACS Medical College and Hospital</strong>
                                    <br> <span style="font-size: 12px">Velappanchavadi, Chennai - 600 077.</span>
                                </P>

                            </div>
                        </div>
                        <table class="table table-bordered">
                            @php
                                $date = $salaryDetails->month_of_salary;
                                $explode = explode('-', $date);
                                $yearNum = $explode[0];
                                $monthNum = $explode[1];
                                $dateObj = DateTime::createFromFormat('!m', $monthNum);
                                $monthName = $dateObj->format('F');
                            @endphp
                            @php
                                $earning = 0;
                                $tds_pf_total = 0;
                                $e_bill_trans_charge_total = 0;
                                $tax_adv_acco_total = 0;
                            @endphp
                            {{-- <tr>
                                <td colspan="5" class="text-center">
                                    <P class="text-center"><strong style="font-size: 12px;">ACS Medical College and
                                            Hospital</strong>
                                        <br> <span class="text-center" style="font-size: 11px">Velappanchavadi,
                                            Chennai - 600 077.</span>
                                    </P>
                                </td>
                            </tr> --}}

                            <tbody>
                                <tr>
                                    <td colspan="4" class="text-center" style="font-size: 12px">
                                        <span>
                                            <b>
                                                @lang('common.payslip')
                                                <span>{{ $monthName . '(' . $yearNum . ')' }}</span>
                                            </b>
                                        </span>
                                    </td>
                                    <td colspan="1" class="text-center">
                                        <span>
                                            <b style="padding-left: 24px;padding-right: 24px;">
                                                {{ $salaryDetails->id }}
                                            </b>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center" style="font-size: 12px">
                                        @lang('common.employee_name')
                                    </td>
                                    <td colspan="2" class="text-center" style="font-size: 12px">
                                        <span><b>{{ $salaryDetails->employee_name }}</b></span>
                                    </td>
                                    <td colspan="1"></td>
                                </tr>
                                <tr>
                                    <td colspan="1" class="text-center" style="font-size: 12px">
                                        @lang('employee.designation')
                                    </td>
                                    <td colspan="1" class="text-center" style="font-size: 12px">
                                        <b>
                                            @if (isset($salaryDetails->designation))
                                                {{ $salaryDetails->designation }}
                                            @endif
                                        </b>
                                    </td>
                                    <td colspan="1" class="text-center" style="font-size: 12px">
                                        <b>{{ $salaryDetails->employee_id }}</b>
                                    </td>
                                    <td colspan="1" class="text-center" style="font-size: 12px">
                                        @lang('employee.department')
                                    </td>
                                    <td colspan="1" class="text-center" style="font-size: 12px">
                                        <b>
                                            @if (isset($salaryDetails->department))
                                                {{ $salaryDetails->department }}
                                            @endif
                                        </b>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="1" class="col-md-3 text-center" style="font-size: 12px">
                                        <b>@lang('common.earning')</b>
                                    </td>
                                    <td colspan="1" class=" col-md-3 text-center" style="font-size: 12px">
                                        <b>@lang('common.amount')</b>
                                    </td>
                                    <td colspan="2" class="col-md-3 text-center" style="font-size: 12px">
                                        <b>@lang('common.deduction')</b>
                                    </td>
                                    <td colspan="1" class=" col-md-3 text-center" style="font-size: 12px">
                                        <b>@lang('common.amount')</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size: 12px">@lang('salary_sheet.basic_salary')</td>
                                    <td class="text-center" style="font-size: 12px">
                                        <span class="text-bold">Rs. </span>
                                        {{ number_format($salaryDetails->basic_salary) }}
                                    </td>
                                    @php
                                        $tds = $salaryDetails->tds;
                                        $pf = $salaryDetails->pf;
                                        $tds_pf_total += $tds + $pf;
                                    @endphp
                                    <td colspan="2" class=" col-md-3 " style="font-size: 12px">TDS/PF</td>
                                    {{-- <td colspan="1" class=" col-md-3 " style="font-size: 12px"></td> --}}
                                    <td class=" col-md-3 text-center" style="font-size: 12px"><span
                                            class="text-bold" style="font-size: 12px">Rs.
                                        </span> {{ number_format($tds_pf_total) }}</td>
                                </tr>
                                <tr>
                                    <td class="col-md-3" style="font-size: 8px">@lang('common.arrears') /
                                        <span style="font-size: 8px">OT / TA / <span
                                                style="font-size: 8px">@lang('common.refund')</span></span>
                                    </td>
                                    @php
                                        $arrs = $salaryDetails->esi;
                                        $ot = $salaryDetails->total_overtime_amount;
                                        $ta = $salaryDetails->ta;
                                        $refund = $salaryDetails->refund;
                                        $tot_earnings = $arrs + $ot + $ta + $refund;
                                        $earning += $tot_earnings;
                                    @endphp
                                    <td id="demo" class="col-md-3 text-center" style="font-size: 12px"><span
                                            class="text-bold">Rs.
                                        </span> {{ $earning }}</td>
                                    <td colspan="2" class="col-md-3 " style="font-size: 12px">ESI</td>
                                    {{-- <td colspan="1" class=" col-md-3 " style="font-size: 12px"></td> --}}
                                    <td class="col-md-3 text-center" style="font-size: 12px">
                                        <span class="text-bold" style="font-size: 12px">Rs. </span>
                                        {{ number_format(round($salaryDetails->esi)) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td colspan="2" class="col-md-3" style="font-size: 12px">
                                        @lang('common.ebill_transaction') :
                                    </td>
                                    @php
                                        $e_bill_trans_charge = $salaryDetails->e_bill + $salaryDetails->trans_charge;
                                        $e_bill_trans_charge_total += $e_bill_trans_charge;
                                    @endphp
                                    <td deduction class="text-center" style="font-size: 12px">
                                        <span class="text-bold">Rs. </span>
                                        {{ $e_bill_trans_charge_total }}
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    @php
                                        $tax_adv_acco = $salaryDetails->prof_tax + $salaryDetails->adv + $salaryDetails->acco;
                                        $tax_adv_acco_total += $tax_adv_acco;
                                    @endphp
                                    <td colspan="2" style="font-size: 12px">@lang('common.adv_acc_pro_tax')</td>
                                    <td class="text-center" style="font-size: 12px">
                                        <span class="text-bold">Rs. </span>
                                        {{ number_format(round($tax_adv_acco_total)) }}
                                </tr>
                                @if ($salaryDetails->total_absence_amount != 0)
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td colspan="2" style="font-size: 12px">@lang('common.loss_of_pay')</td>
                                        {{-- <td colspan="1" class=" col-md-3 "></td> --}}

                                        <td class="text-center" style="font-size: 12px">
                                            <span class="text-bold">Rs. </span>
                                            {{ number_format($salaryDetails->total_absence_amount) }}
                                        </td>
                                    </tr>
                                @endif

                                <tr>
                                    <td class="text-left" style="font-size: 12px">@lang('common.total_earning')</td>
                                    <td class="text-center" style="font-size: 12px">
                                        @php
                                            $total_earning = collect([$salaryDetails->basic_salary, $earning])->sum();

                                        @endphp
                                        <span class="text-bold">Rs. </span>
                                        {{ number_format($total_earning) }}
                                    </td>
                                    <td colspan="2" class="text-left" style="font-size: 12px">
                                        @lang('common.total_deduction')
                                    </td>
                                    @php
                                        $total_deduction = 0;
                                        $total_deduction = collect([$tds_pf_total, $tax_adv_acco_total, $e_bill_trans_charge_total, $salaryDetails->total_absence_amount, $salaryDetails->esi])->sum();
                                    @endphp
                                    <td class="text-center" style="font-size: 12px">
                                        <span class="text-bold">Rs. </span>
                                        {{ number_format($total_deduction) }}
                                    </td>
                                </tr>
                                <th>
                                <td colspan=""></td>
                                @php
                                    $gross_total = $total_earning - $total_deduction;
                                @endphp
                                <td colspan="2" class="text-center" style="background: #ddd;font-size: 12px">
                                    <b>@lang('common.net_amount')</b>
                                </td>
                                <td colspan="1" class="text-center" style="background: #ddd;font-size: 12px">
                                    <b><span class="text-bold">Rs.
                                        </span>{{ round($gross_total) }}</b>
                                </td>
                                </th>
                            </tbody>
                            {{-- <tfoot>
                                <tr>
                                    <td colspan="3"
                                        style="text-align: left;font-size:10px;padding-top: 24px;padding-left: 12px;border-right: 0px">
                                        <strong>@lang('salary_sheet.adminstrator_signature') ...</strong>
                                    </td>
                                    <td colspan="2"
                                        style="text-align: right;font-size:10px;padding-top: 24px;border-left: 0px;padding-right: 12px;">
                                        <strong>@lang('salary_sheet.employee_signature') ...</strong>
                                    </td>
                                </tr>
                            </tfoot> --}}
                        </table>
                    </div>
                </div>
            </div>
            {{-- <footer position="sticky">
                    <div class="clearFix padding">
                        <div class="col-md-4" style="text-align: center;font-size:12px">
                            <strong>@lang('salary_sheet.adminstrator_signature') ...</strong>
                        </div>
                        <div class=" col-md-4" style="text-align: center;font-size:12px">
                            <strong>@lang('common.date') ...</strong>
                        </div>
                        <div class=" col-md-4" style="text-align: center;font-size:12px">
                            <strong>@lang('salary_sheet.employee_signature') ...</strong>
                        </div>
                    </div>
                </footer> --}}
            </div>
        </div>
    </div>
    @section('page_scripts')
        <script type="text/javascript">
            jQuery(function() {
                location.reload();
            });
        </script>
    @endsection
    {{-- <script>
        // $(document).ready(function() { /// Wait till page is loaded
        //     setInterval(timingLoad, 3000);

        //     function timingLoad() {
        //         $('#main').load('printPayslip.blade.php #main', function() {
        //             /// can add another function here
        //         });
        //     }
        // });
    </script> --}}
    <script>
        // function autoRefresh() {
        //     window.location = window.location.href;
        // }
        // setInterval('autoRefresh()', 1000);

        //     $("#printButton").click(function(e) {
        //     window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#printTableData').html()));
        //     e.preventDefault();
        // });
    </script>
</body>

</html>
