<!DOCTYPE html>
<html lang="en">

<head>
    <title>@lang('salary_sheet.employee_payslip')</title>
    <meta charset="utf-8">
</head>
<style>
    table {
        margin: 0 0 40px 0;
        width: 100%;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        display: table;
        border-spacing: 0px;
    }

    table,
    td,
    th {
        border: 1px solid #ddd;
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
        width: 100%;
        border: 1px solid;
        padding: 30px 12px 0px 12px;
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
    <div class="container">
        <div class="row">
            <div class=" companyAddress">
                <div class="headingStyle text-center" style="margin-left: 30px;">
                </div>
                {{-- <h3 style="    margin-left: 80px;"><strong>@lang('salary_sheet.employee_payslip')</strong></h3> --}}
                {{-- <h3 class="text-center"><strong>ACS Medical College and Hospital</strong><br>
                    <h5 class="text-center">Velappanchavadi, Chennai - 600 077.</h5>
                </h3> --}}
            </div>
            <div class="div1">
                <div class="div2">
                    <div class="clearFix">
                        <div class="col-md-full">
                            <div class="table-responsive">
                                <div class="row" style="margin-top: -18px">
                                    <div align="center" class="col-md-full">
                                        <h2><strong>ACS Medical College and Hospital</strong>
                                        </h2>
                                        <h4>Velappanchavadi, Chennai - 600 077.</h4>

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
                            </div>
                        </div>
                    </div>
                    <footer position="sticky">
                        <div class="clearFix padding">
                            <div class="col-md-4" style="text-align: center;">
                                <strong>@lang('salary_sheet.adminstrator_signature') ...</strong>
                            </div>
                            <div class=" col-md-4" style="text-align: center;">
                                <strong>@lang('common.date') ...</strong>
                            </div>
                            <div class=" col-md-4" style="text-align: center;">
                                <strong>@lang('salary_sheet.employee_signature') ...</strong>
                            </div>
                        </div>
                    </footer>

                </div>
            </div>
        </div>
    </div>

</body>

</html>
