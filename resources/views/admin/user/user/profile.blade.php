@extends('admin.master')
@section('content')
@section('title')
    @lang('employee.profile')
@endsection
<style>
    .panel-custom {
        background-color: #F1F1F1;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
        padding: 10px 15px;
    }

    .item {
        padding: 13px 21px;
    }

</style>
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
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
                <div class="panel-heading"><i class="mdi mdi-table fa-fw"></i>
                    @lang('employee.profile')</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <div class="col-xs-6 col-sm-6 col-md-4">
                            <div id="resume">
                                <p><b>User Name : </b><strong>
                                        <span>{{ $employeeInfo->user_name }}</span></strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
