@extends('layout.layout')

@section('title', 'Dashboard')
@section('navSection', 'dashboard')

@section('head')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.2/main.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.2/main.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.1/css/all.css" rel="stylesheet" />
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
                
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            themeSystem: 'bootstrap',
            events: [
                @foreach ($calendarData as $event)
                {
                    title : '{{$event["leaveId"]}}',
                    start : '{{$event["startDate"]}}',
                    end : '{{$event["endDate"]}}',
                    backgroundColor : '{{$event["status"] === LeaveStatus::PENDING ? '#FFC107' : ($event["status"] === LeaveStatus::APPROVED ? '#28A745' : '#DC3545')}}',
                    borderColor: '{{$event["status"] === LeaveStatus::PENDING ? '#FFC107' : ($event["status"] === LeaveStatus::APPROVED ? '#28A745' : '#DC3545')}}',
                    url: '{{url('leave/' . $event["leaveId"])}}'
                },
                @endforeach
            ],
            //This is a workaround for the FullCalendar bug that displays 12a if the event wraps multiple rows
            eventContent: function(args) {
                if (!args.isStart) {
                    return args.event.title
                }
            }
        });
        calendar.render();
        });
</script>
<style>
    .fc th {
        background-color: #DC3545;
        color: #FFFFFF;
    }

    @media (min-width: 576px) {
        .fc th {
            padding: .3rem;
        }
    }

    @media (min-width: 768px) {
        .fc th {
            padding: .75rem;
        }
    }

    .tableUpdates {
        overflow-y: auto;
        height: 250px;
    }

    .tableUpdates thead th {
        position: sticky;
        margin-top: 0px;
        top: 0;
        background: #DC3545;
    }
</style>
@endsection

@section('content')

<div class="container">
    <div class="row my-4">
        <h3 class="col">DASHBOARD</h3>
    </div>
    <div class="row my-4">
        @isset($newUpdates)
        <div class="col-md-4 pr-0 tableUpdates">
            <table class="table table-bordered table-hover">
                <thead class="bg-primary text-light">
                    <tr>
                        <th>Updates</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($newUpdates as $newUpdate)
                    <tr style="cursor:pointer" onclick="window.location = '{{url('leave/' . $newUpdate['leaveId'])}}';">
                        <td>{{$newUpdate['message']}}</td>
                    </tr>
                    @empty
                    <tr style="cursor:pointer">
                        <td>No updates available</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @endisset
        @isset($approvalStatuses)
        <div class="col">
            <table class="table border-right border-left border-bottom table-hover">
                <thead class="bg-primary text-light">
                    <tr>
                        <th>LEAVE ID</th>
                        <th class="text-center">COURSES</th>
                        <th class="text-center">APPROVAL STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($approvalStatuses as $approvalStatus)
                    <tr style="cursor:pointer"
                        onclick="window.location = '{{url('leave/' . $approvalStatus['leaveId'])}}';">
                        <td>{{$approvalStatus['leaveId']}}</td>
                        <td class="text-center">{{$approvalStatus['courses']}}</td>
                        <td class="text-{{$approvalStatus['status'] == LeaveStatus::PENDING ? 'warning' : ($approvalStatus['status'] == LeaveStatus::APPROVED ? 'success' : 'danger') }} text-center
                        ">{{$approvalStatus['status']}}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">There are no approval status</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @endisset
    </div>
    <div class="row my-5">
        <div class="col" id='calendar'></div>
    </div>
</div>
@endsection