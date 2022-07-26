<div class="table-responsive ">
    @php
        $sl = null;
    @endphp
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-info">
                <div class="panel-heading"><i class="mdi mdi-table fa-fw"></i> Employee Info</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body ">
                        <table class="table table-hover">
                            <thead>
                                @php
                                    $sl = 0;
                                @endphp
                                <tr>
                                    <th>Sl/No</th>
                                    <th>Employee Id</th>
                                    <th>Employee Name</th>
                                    <th>Designation</th>
                                    <th>Department</th>
                                </tr>
                            </thead>
                            @php
                                $sl++;
                            @endphp
                            @foreach ($monthlyDetails as $keys => $v)
                                <tbody>
                                    <tr>
                                        <td>{{ (int) $sl + (int) $keys }}</td>
                                        <td>{{ $v->employee_id }}</td>
                                        <td>{{ $v->employee_name }}</td>
                                        <td>{{ $v->designation }}</td>
                                        <td>{{ $v->department }}</td>
                                    </tr>
                                </tbody>
                            @endforeach
                        </table>
                        <div class="text-center" style="padding-top: 20px ">
                            {{ $monthlyDetails->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
