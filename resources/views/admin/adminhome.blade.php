@extends('admin.master')
@section('content')
@section('title')
    @lang('dashboard.dashboard')
@endsection
<style>
    .dash_image {

        width: 60px;
    }

    thead,
    tbody tr {
        display: table;
        width: 100%;
        table-layout: fixed;
    }

    thead {
        width: calc(100% - 1em)
    }

</style>

<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <ol class="breadcrumb">
                <li class="active breadcrumbColor"><a href="#"><i class="fa fa-home"></i>
                        @lang('dashboard.dashboard')</a></li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-sm-6 col-xs-12">
            <div class="white-box analytics-info">
                <h3 class="box-title"> @lang('dashboard.total_employee') </h3>
                <ul class="list-inline two-part">
                    <li>
                        <img class="dash_image" src="{{ asset('admin_assets/img/employee.png') }}">
                    </li>
                    <li class="text-right"><i class="ti-arrow-up text-success"></i> <span
                            class="counter text-success">{{ $totalEmployees }}</span></li>
                </ul>
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-xs-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Total @lang('dashboard.total_department')</h3>
                <ul class="list-inline two-part">
                    <li>
                        <img class="dash_image" src="{{ asset('admin_assets/img/department.png') }}">
                    </li>
                    <li class="text-right"><i class="ti-arrow-up text-purple"></i> <span
                            class="counter text-purple">{{ count($totalDepartment) }}</span></li>
                </ul>
                {{-- @php
                    dd($totalDepartment);
                @endphp --}}
            </div>
        </div>

        {{-- <div class="col-lg-4 col-sm-6 col-xs-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Last Month Spending</h3>
                <ul class="list-inline two-part">
                    <li>
                        <img class="dash_image" src="{{ asset('admin_assets/img/present.png') }}">
                    </li>
                    <?php
                    // $number = 1234.56;
                    // setlocale(LC_MONETARY,"en_US");
                    // echo money_format("The price is %i", $number);
                    ?>
                    <li class="text-right"><span class="text-info">&#2352 </span><span
                            class="counter text-info">
                            {{ $monthlySpending . '.0' }}</span></li>
                </ul>
            </div>
        </div> --}}
    </div>
    <div class="data">
        @include('admin.pagination');
    </div>

</div>

@endsection


@section('page_scripts')
<link href="{!! asset('admin_assets/plugins/bower_components/news-Ticker-Plugin/css/site.css') !!}" rel="stylesheet" type="text/css" />
<script src="{!! asset('admin_assets/plugins/bower_components/news-Ticker-Plugin/scripts/jquery.bootstrap.newsbox.min.js') !!}"></script>
<script type="text/javascript">
    $(function() {

        $(".demo1").bootstrapNews({
            newsPerPage: 2,
            autoplay: true,
            pauseOnHover: true,
            direction: 'up',
            newsTickerInterval: 4000,
            onToDo: function() {
                //console.log(this);
            }
        });

    });

    $(function() {

        $('.data').on('click', '.pagination a', function(e) {
            getData($(this).attr('href').split('page=')[1]);
            e.preventDefault();
        });
    });
</script>
@endsection
