@extends('admin.master')
@section('content')
@section('title')
    @lang('salary_sheet.employee_payslip')
@endsection
<style>
    .table>tbody>tr>td {
        padding: 5px 7px;
    }

</style>
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
            <ol class="breadcrumb">
                <li class="active breadcrumbColor"><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i>
                        @lang('dashboard.dashboard')</a></li>
                <li>@yield('title')</li>

            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"><i class="mdi mdi-clipboard-text fa-fw"></i>
                    @lang('salary_sheet.employee_payslip')</div>
                <div class="col-md-12 text-right">
                    <h4 style="">
                        <div class="row">
                            <a class="btn btn-success" style="color: #fff;margin-right:16px"
                                href="{{ URL('downloadPayslip/' . $paySlipId) }}"><i class="fa fa-download fa-lg"
                                    aria-hidden="true"></i> @lang('common.download') PDF</a>
                        </div>
                    </h4>
                </div>
                <div class="row" style="margin-top: 25px">
                    <div class="col-md-12 text-center">
                        {{-- <h3><strong>ACS Medical College and Hospital</strong><br>
                            <h4>Velappanchavadi, Chennai - 600 077.</h4>
                        </h3> --}}
                    </div>
                </div>
                @php
                    $earning = 0;
                    $tds_pf_total = 0;
                    $e_bill_trans_charge_total = 0;
                    $tax_adv_acco_total = 0;
                @endphp
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body" style="    padding: 18px 49px;">
                        <div class="row" style="border: 1px solid #ddd;padding: 26px 9px">
                            <div class="col-md-full" id="payslipTableData">
                                <div class="row" style="margin-top: -18px">
                                    <div align="center" class="col-md-full">
                                        <h2><strong>ACS Medical College and Hospital</strong><br>
                                            <h4>Velappanchavadi, Chennai - 600 077.</h4>
                                        </h2>
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
                                    {{-- <tr>
                                        <td colspan="5" class="text-center" style="border-bottom: 0px;">
                                            <h4><strong>ACS Medical College and Hospital</strong><br>
                                                <h5>Velappanchavadi, Chennai - 600 077.</h5>
                                            </h4>
                                        </td>
                                    </tr> --}}
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            <span>
                                                <h5><b>
                                                        @lang('common.payslip')
                                                        <span>{{ $monthName . '(' . $yearNum . ')' }}</span>
                                                </h5></b>
                                            </span>
                                        </td>
                                        <td colspan="1" class="text-center" style="border-bottom: 0px;">
                                            <span>
                                                <h4><b style="padding-left: 48px;padding-right: 48px;">
                                                        {{ $salaryDetails->id }}
                                                </h4></b>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="">
                                            @lang('common.employee_name') :
                                        </td>
                                        <td colspan="2" class="text-center">
                                            <span><b>{{ $salaryDetails->employee_name }}</b></span>
                                        </td>
                                        <td colspan="1"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="1" class="">
                                            @lang('employee.designation') :
                                        </td>
                                        <td colspan="1" class="text-center">
                                            <b>
                                                @if (isset($salaryDetails->designation))
                                                    {{ $salaryDetails->designation }}
                                                @endif
                                            </b>
                                        </td>
                                        <td colspan="1" class="text-center">
                                            <b>{{ $salaryDetails->employee_id }}</b>
                                        </td>
                                        <td colspan="1" class="">
                                            @lang('employee.department') :
                                        </td>
                                        <td colspan="1" class="text-center">
                                            <b>
                                                @if (isset($salaryDetails->department))
                                                    {{ $salaryDetails->department }}
                                                @endif
                                            </b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1" class="col-md-3 text-center"><b>@lang('common.earning')</b>
                                        </td>
                                        <td colspan="1" class=" col-md-3 text-center"><b>@lang('common.amount')</b>
                                        </td>
                                        <td colspan="2" class="col-md-3 text-center">
                                            <b>@lang('common.deduction')</b>
                                        </td>
                                        <td colspan="1" class=" col-md-3 text-center"><b>@lang('common.amount')</b>
                                        </td>
                                    </tr>
                                    <tbody>
                                        <tr>
                                            <td>@lang('salary_sheet.basic_salary') : </td>
                                            <td class="text-center">
                                                <span class="text-bold">Rs. </span>
                                                {{ number_format($salaryDetails->basic_salary) }}
                                            </td>
                                            @php
                                                $tds = $salaryDetails->tds;
                                                $pf = $salaryDetails->pf;
                                                $tds_pf_total += $tds + $pf;
                                            @endphp
                                            <td colspan="1" class=" col-md-3 ">TDS/PF:</td>
                                            <td colspan="1" class=" col-md-3 "></td>
                                            <td class=" col-md-3 text-center"><span class="text-bold">Rs.
                                                </span> {{ number_format($tds_pf_total) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-3 ">@lang('common.arrears') /
                                                <span>OT / TA / <span>@lang('common.refund'):</span></span>
                                            </td>
                                            @php
                                                $arrs = $salaryDetails->esi;
                                                $ot = $salaryDetails->total_overtime_amount;
                                                $ta = $salaryDetails->ta;
                                                $refund = $salaryDetails->refund;
                                                $tot_earnings = $arrs + $ot + $ta + $refund;
                                                $earning += $tot_earnings;
                                            @endphp
                                            <td id="demo" class="col-md-3 text-center"><span class="text-bold">Rs.
                                                </span> {{ $earning }}</td>
                                            <td colspan="1" class="col-md-3 ">ESI :</td>
                                            <td colspan="1" class=" col-md-3 "></td>
                                            <td class="col-md-3 text-center">
                                                <span class="text-bold">Rs. </span>
                                                {{ number_format(round($salaryDetails->esi)) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td colspan="2" class="col-md-3">@lang('common.ebill_transaction') :
                                            </td>
                                            @php
                                                $e_bill_trans_charge = $salaryDetails->e_bill + $salaryDetails->trans_charge;
                                                $e_bill_trans_charge_total += $e_bill_trans_charge;
                                            @endphp
                                            <td deduction class="text-center">
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
                                            <td colspan="2">@lang('common.adv_acc_pro_tax'): </td>
                                            <td class="text-center">
                                                <span class="text-bold">Rs. </span>
                                                {{ number_format(round($tax_adv_acco_total)) }}
                                        </tr>
                                        @if ($salaryDetails->total_absence_amount != 0)
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td colspan="1">@lang('common.loss_of_pay') : </td>
                                                <td colspan="1" class=" col-md-3 "></td>

                                                <td class="text-center">
                                                    <span class="text-bold">Rs. </span>
                                                    {{ number_format($salaryDetails->total_absence_amount) }}
                                                </td>
                                            </tr>
                                        @endif

                                        <tr>
                                            <td> <b>@lang('common.total_earning') : </b></td>
                                            <td class="text-center">
                                                @php
                                                    $total_earning = collect([$salaryDetails->basic_salary, $earning])->sum();

                                                @endphp
                                                <span class="text-bold">Rs. </span>
                                                {{ number_format($total_earning) }}
                                            </td>
                                            <td colspan="2"> <b>@lang('common.total_deduction') : </b></td>
                                            @php
                                                $total_deduction = 0;
                                                $total_deduction = collect([$tds_pf_total, $tax_adv_acco_total, $e_bill_trans_charge_total, $salaryDetails->total_absence_amount, $salaryDetails->esi])->sum();
                                            @endphp
                                            <td class="text-center">
                                                <span class="text-bold">Rs. </span>
                                                {{ number_format($total_deduction) }}
                                            </td>
                                        </tr>
                                        <th>
                                        <td colspan=""></td>
                                        @php
                                            $gross_total = $total_earning - $total_deduction;
                                        @endphp
                                        <td colspan="2" class="text-center" style="background: #ddd; padding: 12px;">
                                            <b>@lang('common.net_amount'):</b>
                                        </td>
                                        <td colspan="1" class="text-center" style="background: #ddd; padding: 12px;">
                                            <b><span class="text-bold">Rs.
                                                </span>{{ round($gross_total) }}</b>
                                        </td>
                                        </th>
                                    </tbody>
                                </table>
                                <script>
                                    function myFunction() {
                                        var x = document.getElementById("myText").value;
                                        document.getElementById("demo").innerHTML = x;
                                    }
                                </script>
                            </div>
                            <div class="row">
                                <div class="col-md-6"></div>
                                <div class="col-md-6"></div>
                            </div>
                            <div class="col-md-4">
                                <p style="font-weight: 500;">@lang('salary_sheet.adminstrator_signature') ....</p>
                            </div>
                            <div class="col-md-4 text-center">
                                <p style="font-weight: 500;"> @lang('common.date') .... </p>
                            </div>
                            <div class="col-md-4 text-right">
                                <p style="font-weight: 500;"> @lang('salary_sheet.employee_signature') .... </p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <script lang='javascript'>
    $(document).ready(function() {
        $('#printPage').click(function() {
            var data = '<input type="button" value="Print this page" onClick="window.print()">';
            data += '<div id="div_print">';
            data += $('#report').html();
            data += '</div>';

            myWindow = window.open('', '', '');
            myWindow.innerWidth = screen.width;
            myWindow.innerHeight = screen.height;
            myWindow.screenX = 0;
            myWindow.screenY = 0;
            myWindow.document.write(data);
            myWindow.focus();
        });
    });
</script> --}}
@endsection

{{-- <script>
    function printData() {
        var print_ = document.getElementById("payslip_table");
        win = window.open("");
        win.document.write(print_.outerHTML);
        win.print();
        win.close();
    }
</script> --}}
