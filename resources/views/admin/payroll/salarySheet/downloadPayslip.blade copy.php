@extends('admin.master')
@section('content')
@section('title')
    @lang('salary_sheet.download_payslip')
@endsection
<style>
    body {

        font-family: 'Nunito', sans-serif;

    }

    #hideMe {
        -webkit-animation: seconds 1.0s forwards;
        -webkit-animation-iteration-count: 1;
        -webkit-animation-delay: 3s;
        animation: seconds 1.0s forwards;
        animation-iteration-count: 1;
        animation-delay: 3s;
        position: relative;
    }

    @-webkit-keyframes seconds {
        0% {
            opacity: 1;
        }

        100% {
            opacity: 0;
            left: -9999px;
            position: absolute;
        }
    }

    @keyframes seconds {
        0% {
            opacity: 1;
        }

        100% {
            opacity: 0;
            left: -9999px;
            position: absolute;
        }
    }

    th {
        background-color: rgb(65, 179, 249);
        color: white;
    }

    td {
        font-size: 13px
    }
</style>
<div class="container-fluid">
    {{-- <meta http-equiv="refresh" content="2"> --}}
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
        <div class="col-sm-12">
            <div class="panel panel-info">
                <div class="panel-heading"><i class="mdi mdi-table fa-fw"></i> @yield('title')</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">×</button>
                                <i
                                    class="cr-icon glyphicon glyphicon-ok"></i>&nbsp;<strong>{{ session()->get('success') }}</strong>
                            </div>
                        @endif
                        @if (session()->has('error'))
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">×</button>
                                <strong>{{ session()->get('error') }}</strong>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <label for="exampleInput">@lang('common.month')<span class="validateRq"></span></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    {!! Form::text('month', isset($month) ? $month : '', $attributes = ['class' => 'form-control required monthField', 'id' => 'month', 'placeholder' => __('common.month')]) !!}
                                </div>
                            </div>
                            <div class="text-right">
                                <a href="{{ url('generateSalarySheet/employeePayslip') }}" target="_blank"><button
                                        class="btn btn-info  waves-effect waves-light"
                                        style="margin-top: 28px;margin-right:18px;width: 140px"><span>Print
                                            Payslip</span>
                                    </button></a>
                            </div>
                            {{-- <div class="text-right">
                                <a href="{{ url('generateSalarySheet/employeePayslip') }}" onclick="window.print()" target="_blank"><button
                                        class="btn btn-info  waves-effect waves-light"
                                        style="margin-top: 28px;margin-right:18px;width: 140px"><span>Print
                                            Payslip</span>
                                    </button></a>
                            </div> --}}
                        </div>
                        <br>
                        <br>
                        <div class="data">
                            @include('admin.payroll.salarySheet.pagination')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_scripts')
<script>
    $(function() {
        $('.data').on('click', '.pagination a', function(e) {
            getData($(this).attr('href').split('page=')[1]);
            e.preventDefault();
        });
        $(".monthField").change(function() {
            getData(1);
        });
    });

    function getData(page) {
        var monthField = $('.monthField').val();
        $.ajax({
            url: '?page=' + page + "&monthField=" + monthField,
            datatype: "html",
        }).done(function(data) {
            $('.data').html(data);
            $("html, body").animate({
                scrollTop: 80
            }, 150);
        }).fail(function() {
            $.toast({
                heading: 'Warning',
                text: 'Something Error Found !, data could not be loaded. !',
                position: 'top-right',
                loaderBg: '#ff6849',
                icon: 'success',
                hideAfter: 3000,
                stack: 6
            });
        });
    }

    $('#print').on('click', function() {

        let CSRF_TOKEN = $('meta[name="csrf-token"').attr('content');

        $.ajaxSetup({
            url: 'generateSalarySheet/employeePayslip',
            type: 'GET',
            data: {
                _token: CSRF_TOKEN,
            },
            beforeSend: function() {
                console.log('printing ...');
            },
            complete: function() {
                console.log('printed!');
            }
        });

        $.ajax({
            success: function(viewContent) {
                $.print(
                    viewContent
                ); // This is where the script calls the printer to print the viwe's content.
            }
        });
    });

    function autoRefresh() {
        window.location = window.location.href;
        window.print();
    }
    setInterval('autoRefresh()', 1000);
</script>
@endsection
