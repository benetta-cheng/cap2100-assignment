@extends('layout.layout')

@section('title', 'History Page')
@section('navSection', 'history')

@section('head')
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/css/tempusdominus-bootstrap-4.min.css"
    integrity="sha512-PMjWzHVtwxdq7m7GIxBot5vdxUY+5aKP9wpKtvnNBZrVv1srI8tU6xvFMzG8crLNcMj/8Xl/WWmo/oAP/40p1g=="
    crossorigin="anonymous" />
<link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.1/css/all.css" rel="stylesheet" />
@endsection

@section('content')
<div class="container">
    <div class="row my-4">
        <h3 class="col">HISTORY</h3>
    </div>
    <form>
        <div class="row my-4">
            <div class="col form-group">
                <label for="dateApplied" class="mr-sm-2">Absent Period:</label>
                <div class="row">
                    <div class="col input-group date" id="datetimepicker1" data-target-input="nearest">
                        <input name="leaveDateFrom" id="dateApplied1" type="text"
                            class="form-control datetimepicker-input" data-target="#datetimepicker1" placeholder="From"
                            onkeydown="return false;" />
                        <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    <div class="col input-group date" id="datetimepicker2" data-target-input="nearest">
                        <input name="leaveDateTo" id="dateApplied2" type="text"
                            class="form-control datetimepicker-input" data-target="#datetimepicker2" placeholder="To"
                            onkeydown="return false;" />
                        <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="approvalStatus">Approval Status:</label>
                    <select name="approvalStatus" class="form-control" id="approvalStatus" aria-placeholder="Status">
                        <option style="display:none" disabled selected value>Status</option>
                        <option>{{LeaveStatus::APPROVED}}</option>
                        <option>{{LeaveStatus::PENDING}}</option>
                        <option>{{LeaveStatus::REJECTED}}</option>
                        <option>{{LeaveStatus::CANCELLED}}</option>
                    </select>
                </div>
            </div>
        </div>
        @if ($userRole == UserType::STUDENT)
        <div class="row my-4 pb-4">
            <div class="col-10">
                <div class="form-group mb-0">
                    <label for="leaveId" class="mr-sm-2">Leave ID:</label>
                    <input name="leaveId" class="form-control" placeholder="Leave ID">
                </div>
            </div>
            <div class="col d-flex align-items-end justify-content-end">
                <button class="btn btn-danger" type="submit">Filter</button>
            </div>
        </div>
        @else
        <div class="row my-4">
            <div class="col">
                <div class="form-group">
                    <label for="leaveId" class="mr-sm-2">Name:</label>
                    <input name="name" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="leaveId" class="mr-sm-2">Course:</label>
                    <input name="course" class="form-control" placeholder="Course ID">
                </div>
            </div>
        </div>
        <div class="row my-4">
            <div class="button col offset-12">
                <button class="btn btn-danger" type="submit">Filter</button>
            </div>
        </div>
        @endif
    </form>
    <div class="row">
        <table class="table table-hover col">
            <thead>
                <tr>
                    <th>Leave ID</th>
                    @if ($userRole != UserType::STUDENT)
                    @if ($userRole != UserType::IO)
                    <th class="text-center">Course</th>
                    @endif
                    <th class="text-center">Student</th>
                    @endif
                    <th class="text-center">Approval Status</th>
                    <th class="text-center">Date Processed</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($leaves as $leave)
                <tr style="cursor:pointer" onclick="window.location='leave/{{$leave['leaveId']}}';">
                    <td>{{$leave['leaveId']}}</td>
                    @if ($userRole != UserType::STUDENT)
                    @if ($userRole != UserType::IO)
                    <td class="text-center">{{$leave['courseId']}}</td>
                    @endif
                    <td class="text-center">{{$leave['student']}}</td>
                    @endif
                    <td
                        class="text-center text-{{$leave['status'] == LeaveStatus::PENDING ? 'warning' : ($leave['status'] == LeaveStatus::APPROVED ? 'success' : 'danger' )}}">
                        {{$leave['status']}}</td>
                    <td class="text-center">{{date('d-m-Y', strtotime($leave['createdAt']))}}</td>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">There is no history</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/js/tempusdominus-bootstrap-4.min.js"
    integrity="sha512-2JBCbWoMJPH+Uj7Wq5OLub8E5edWHlTM4ar/YJkZh3plwB2INhhOC3eDoqHm1Za/ZOSksrLlURLoyXVdfQXqwg=="
    crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#datetimepicker1').datetimepicker({
            format: 'DD-MM-YYYY',
            useCurrent: false
        });
        $('#datetimepicker2').datetimepicker({
            format: 'DD-MM-YYYY',
            useCurrent: false
        });
    });
    
    $("#dateApplied1").click(function() {
        $('#datetimepicker1').datetimepicker('show');
    });
    $("#dateApplied2").click(function() {
        $('#datetimepicker2').datetimepicker('show');
    });

    $("#datetimepicker1").on("change.datetimepicker", function (e) {
        $('#datetimepicker2').datetimepicker('minDate', e.date);
    });
    $("#datetimepicker2").on("change.datetimepicker", function (e) {
        $('#datetimepicker1').datetimepicker('maxDate', e.date);
    });
</script>
@endsection