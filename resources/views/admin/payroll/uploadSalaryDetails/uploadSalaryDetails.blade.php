@extends('admin.master')
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
                            <div class="col-md-3 col-sm-1"></div>
                            <div>
                                <label class="control-label text-left" style="margin-top: 8px;margin-left: 18px;"
                                    for="date">@lang('common.month')
                                    :</label>
                            </div>
                            <div class="col-md-3 col-sm-1"></div>
                            <div class="col-md-6" style="margin-top: 12px;margin-bottom: 12px;">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control dateField required" readonly
                                        placeholder="@lang('common.month')" name="month"
                                        value=" @if (isset($date)) {{ $date }}@else{{ dateConvertDBToForm(date('Y-m-d')) }} @endif">
                                </div>
                            </div>
                            {{-- <div>
                                @if (count($results) > 0)
                                <div class="row" style="margin-top: 13px;margin-bottom: 12px;margin-right: 12px;">
                                    <div class="text-right" style="margin-bottom: 6px;">
                                        <input type="button" id="tableexport" class="btn btn-info" value="Daily Report"
                                            style="margin-left: 12px;width: 130px" />
                                    </div>
                                </div>
                                @endif
                            </div> --}}
                            <div class="row flex-row">
                                {{-- <div class="col-md-1" id="tableexport"
                                    style="margin-top: 13px;margin-bottom: 12px;margin-right: 12px;">
                                    <button id="tableexport" class="btn btn-info dailyReport">Daily
                                        Report</button>
                                </div> --}}
                                <div class="col-md-1" id="pdfexport"
                                    style="margin-top: 13px;margin-bottom: 12px;margin-right: 12px;">
                                    <button id="pdfexport" onclick="" class="btn btn-info">Export
                                        Report .xls</button>
                                </div>
                            </div>
                            {{-- <a href="{{ route('uploadSalaryDetails.downloadReport') }}" id="tableexport"
                                style="margin-top: 13px;margin-bottom: 12px;margin-right: 12px;">
                                <button id="tableexport" class="btn btn-info dailyReport " id="dailyReport">Daily
                                    Report</button>
                            </a> --}}
                        </div>
                        <div class="data">
                            <div class="panel">
                                @include('admin.payroll.uploadSalaryDetails.pagination')
                            </div>
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
                scrollTop: 450
            }, 500);
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


    $("#tableexport").click(function(e) {
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#btableData').html()));
        e.preventDefault();
    });

    $(document).ready(function() {
    $("#pdfexport").click(function(e) {
        //getting values of current time for generating the file name
        var dt = new Date();
        var day = dt.getDate();
        var month = dt.getMonth() + 1;
        var year = dt.getFullYear();
        var hour = dt.getHours();
        var mins = dt.getMinutes();
        var postfix = day + "." + month + "." + year + "_" + hour + "." + mins;
        //creating a temporary HTML link element (they support setting file names)
        var a = document.createElement('a');
        //getting data from our div that contains the HTML table
        var data_type = 'data:application/vnd.ms-excel';
        var table_div = document.getElementById('btableData');
        var table_html = table_div.outerHTML.replace(/ /g, '%20');
        a.href = data_type + ', ' + table_html;
        //setting the file name
        a.download = 'salary_details_' + postfix + '.xls';
        //triggering the function
        a.click();
        //just in case, prevent default behaviour
        e.preventDefault();
    });


});
</script>


<script type="text/javascript">
    function demoFromHTML() {
        var pdf = new jsPDF('p', 'pt', 'letter');
        // source can be HTML-formatted string, or a reference
        // to an actual DOM element from which the text will be scraped.
        source = $('#customers')[0];

        // we support special element handlers. Register them with jQuery-style
        // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
        // There is no support for any other type of selectors
        // (class, of compound) at this time.
        specialElementHandlers = {
            // element with id of "bypass" - jQuery style selector
            '#bypassme': function(element, renderer) {
                // true = "handled elsewhere, bypass text extraction"
                return true
            }
        };
        margins = {
            top: 80,
            bottom: 60,
            left: 40,
            width: 522
        };
        // all coords and widths are in jsPDF instance's declared units
        // 'inches' in this case
        pdf.fromHTML(
                source, // HTML string or DOM elem ref.
                margins.left, // x coord
                margins.top, {// y coord
                    'width': margins.width, // max width of content on PDF
                    'elementHandlers': specialElementHandlers
                },
        function(dispose) {
            // dispose: object with X, Y of the last line add to the PDF
            //          this allow the insertion of new lines after html
            pdf.save('Test.pdf');
        }
        , margins);
    }
</script>

{{-- <script>
    // $("#template1").click(function(e) {
    //     window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#btableData').html()));
    //     e.preventDefault();
    // });
</script> --}}
@endsection
