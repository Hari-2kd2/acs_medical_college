<!-- @extends('admin.master')
@section('content')
@section('title')
    @lang('payroll_setup.upload_salary_details')
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
    <div class="row bg-title">
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
            <ol class="breadcrumb">
                <li class="active breadcrumbColor"><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i>
                        @lang('dashboard.dashboard')</a></li>
                <li>@yield('title')</li>
            </ol>
        </div>
    </div>
    <div class="row container-fluid">
        <div class="col-sm-12">
            <div class="panel panel-info">
                @if (count($errors) > 0)
                    <div class="alert alert-danger alert-block" style="margin-top: 12px;">
                        Upload Validation
                        Error<button type="button" class="close" data-dismiss="alert">x</button>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>

                    </div>
                @endif
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block" style="margin-top: 12px;">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                @if ($message = Session::get('danger'))
                    <div class="alert alert-danger alert-block" style="margin-top: 12px;">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                <div class="panel-heading"><i class="mdi mdi-table fa-fw"></i> @yield('title')</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <div class="bg-title border" style="margin-left: 14px;margin-right: 14px">
                            <form action="{{ Url('uploadSalaryDetails/import') }}" method="post"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <p class="border" style="margin-left: 24px"><span><i
                                            class="fa fa-upload"></i></span><span style="margin-left: 8px"> Upload
                                        Excel
                                        File Here</span></p>
                                <div class="row">
                                    <div class="col-md-8 col-sm-5" style="margin-left: 56px;  margin-bottom: 2px;">
                                        <input type="file" name="select_file" class="form-control">
                                    </div>
                                    <div class="col-sm-1">
                                        <input class="btn btn-success" style="margin-top:2px;width:100px" type="submit"
                                            value="Upload">
                                    </div>
                                    <div class="text-right" style="margin-right: 24px;">
                                        @php
                                            $path = 'app\public\templates\template1.xlsx';
                                        @endphp
                                        <a href="{{ route('uploadSalaryDetails.downloadFile') }}">
                                            <input type="button" id="template1" class="btn btn-info template1"
                                                value="Sample format" type="submit"
                                                style="margin-top: 2px;width: 150px" />
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-info">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <div class="row bg-title" style="margin-left: 1px;margin-right: 1px;">
                            <div class="col-md-3 col-sm-2"></div>
                            {{-- <label class="control-label" style="margin-top: 8px;" for="date">@lang('common.month')
                                    :</label> --}}
                            <div class="col-md-6" style="margin-top: 12px;margin-bottom: 12px;">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control dateField required" readonly
                                        placeholder="@lang('common.month')" name="month"
                                        value=" @if (isset($date)) {{ $date }}@else{{ dateConvertDBToForm(date('Y-m-d')) }} @endif">
                                </div>
                            </div>
                            <div class="Report"
                                style="margin-top: 13px;margin-bottom: 12px;margin-right: 12px;">
                                <a href="{{ URL('filter') }}"><button class="btn btn-info Report " id="Report">Daily
                                        Report</button></a>
                            </div>
                        </div>
                        <div class="data">
                            @include('admin.payroll.uploadSalaryDetails.pagination')
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

        $(".dateField").change(function() {
            getData(1);
        });
    });

    function getData(page) {
        var dateField = $('.dateField').val();
        $.ajax({
            url: '?page=' + page + "&dateField=" + dateField,
            datatype: "html",
        }).done(function(data) {
            $('.data').html(data);
            $("html, body").animate({
                scrollTop: 0
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

    // // $("#Report").click(function(e) {
    // $(document).on('click', '.Report', function() {
    //     var dateField = $('.dateField').val();
    //     var token = $(this).attr('data-token');
    //     var actionTo = $(this).attr('href');
    //     alert(dateField);
    //     e.preventDefault();
    //     $.ajax({
    //         url: actionTo,
    //         type: 'get',
    //         data: {
    //             dateField: dateField,
    //             _token: token
    //         },
    //         success: function(response) {

    //         }

    //     });
    // });


    $(document).ready(function () {
    var date = new Date();

    $('.dateField').datepicker({
        todayBtn: 'linked',
        format: 'yyyy-mm-dd',
        autoclose: true
    });

    var _token = $('input[name="_token"]').val();

    fetch_data();

    function fetch_data(dateField = '') {
        $.ajax({
            url: "{{ route('filter.fetch_data') }}",
            method: "POST",
            data: {
                dateField: dateField,
                _token: _token
            },
            dataType: "json",
            success: function (data) {
                var output = '';
                $('#total_records').text(data.length);
                for (var count = 0; count < data.length; count++) {
                    output += '<tr>';
                    output += '<td>' + data[count].owner_manager + '</td>';
                    output += '<td>' + data[count].csr_name + '</td>';
                    output += '<td>' + data[count].csr_eid + '</td>';
                }
                $('tbody').html(output);
            }
        })
    }

    $('#filter').click(function () {
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        if (from_date != '' && to_date != '') {
            fetch_data(from_date, to_date);
        } else {
            alert('Both Date is required');
        }
    });

    // $('#refresh').click(function () {
    //     $('#from_date').val('');
    //     $('#to_date').val('');
    //     fetch_data();
    // });
});
</script>
@endsection -->
