@extends('layout.layout')

@section('title', 'History Page')

@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/css/tempusdominus-bootstrap-4.min.css" integrity="sha512-PMjWzHVtwxdq7m7GIxBot5vdxUY+5aKP9wpKtvnNBZrVv1srI8tU6xvFMzG8crLNcMj/8Xl/WWmo/oAP/40p1g==" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.1/css/all.css" rel="stylesheet" />
@endsection
        
@section('content')
<div class="container">
    <div class="row my-4">
        <h3 class="col">HISTORY</h3>
    </div>
    <form>
        <div class ="row my-4">
            <div class="col form-group">
                <label for="dateApplied" class="mr-sm-2">Date Applied:</label>
                <div class="row">
                    <div class="col input-group date" id="datetimepicker1" data-target-input="nearest">
                        <input id="dateApplied" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1" placeholder="From"/>
                        <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    <div class="col input-group date" id="datetimepicker2" data-target-input="nearest">
                        <input id="dateApplied" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker2" placeholder="To"/>
                        <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="dropdown">
                    <label for="approvalStatus" class="mr-sm-2">Approval Status:</label>
                    <button class="btn btn-block btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown">Status</button>
                    <div class="dropdown-menu btn-block">
                        <a class="dropdown-item" href="#">Approved</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Pending</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Rejected</a>
                    </div>
                </div>
            </div>
        </div>
        @if ($userRole == 'Student')
        <div class="row my-4 pb-4">
            <div class="col-10">
                <div class="form-group mb-0">
                    <label for="leaveId" class="mr-sm-2">Leave ID:</label>
                    <input class="form-control" placeholder="Leave ID">
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
                    <input class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="leaveId" class="mr-sm-2">Course:</label>
                    <input class="form-control" placeholder="Course Name">
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
                    @if ($userRole != 'Student')
                    <th class="text-center">Course</th>
                    <th class="text-center">Student</th>
                    @endif
                    <th class="text-center">Approval Status</th>
                    <th class="text-center">Date Processed</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($leaves as $leave)
                <tr>
                    <td>{{$leave['leaveId']}}</td>
                    @if ($userRole != 'Student')
                    <td class="text-center">{{$leave['courseId']}}</td>
                    <td class="text-center">{{$leave['student']}}</td>
                    @endif
                    <td class="text-center text-{{$leave['approvalStatus'] == 'APPROVED' ? 'success' : ($leave['approvalStatus'] == 'REJECTED' ? 'danger' : 'warning') }}">{{$leave['approvalStatus']}}</td>
                    <td class="text-center">{{$leave['dateApplied']}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">There is no history</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="row">
        <nav class="col" aria-label="Page navigation">
            <ul class="pagination justify-content-end">
                <li class="page-item @if($pageData['currentPage'] == 1) disabled @endif">
                    <a class="page-link" href="#" @if($pageData['currentPage'] == 1) tabindex="-1" @endif>Previous</a>
                </li>
                @for ($i = 1; $i <= $pageData['maxPage']; $i++)
                    @if ($i == $pageData['currentPage'])
                        <li class="page-item active">
                            <a class="page-link" href="#">{{$i}}<span class="sr-only">(current)</span></a>
                        </li>
                    @else
                        <li class="page-item"><a class="page-link" href="#">{{$i}}</a></li>
                    @endif
                @endfor
                <li class="page-item @if($pageData['currentPage'] == $pageData['maxPage']) disabled @endif">
                    <a class="page-link" href="#" @if($pageData['currentPage'] == $pageData['maxPage']) tabindex="-1" @endif>Next</a>
                </li>
            </ul>
        </nav>
    </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/js/tempusdominus-bootstrap-4.min.js" integrity="sha512-2JBCbWoMJPH+Uj7Wq5OLub8E5edWHlTM4ar/YJkZh3plwB2INhhOC3eDoqHm1Za/ZOSksrLlURLoyXVdfQXqwg==" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#datetimepicker1').datetimepicker({
                format: 'L'
            });
            $('#datetimepicker2').datetimepicker({
                format: 'L'
            });
        });
    </script>
@endsection