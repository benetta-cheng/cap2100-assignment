@extends('layout.layout')

@section('title', 'Leave Status Detail')

@section('head')
<style>
    /* Might want to move this to a styles.css for the whole project if it is frequently used */
    .chevron::before {
        vertical-align: text-top;
        content: url("data:image/svg+xml,<svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-chevron-down' fill='currentColor' xmlns='http://www.w3.org/2000/svg'><path fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/></svg>");
    }

    .chevron {
        display: inline-block;
        transition: .3s transform ease-in-out;
    }

    .collapsed .chevron {
        transform: rotate(-90deg);
    }
</style>
@endsection

@section('content')
{{-- userRole will probably be removed when proper authentication is setup --}}
@if ($details['leaveStatus'] != "APPROVED" && $details['leaveStatus'] != "REJECTED")
@if ($userRole == "Student")
{{-- Cancellation Modal --}}
<div class="modal fade" id="cancellationModal" tabindex="-1" role="dialog" aria-labelledby="cancellationModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancellationModalTitle">Leave Cancellation Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Confirm to cancel this leave application?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No, go back</button>
                <button type="button" class="btn btn-danger">Cancel Leave Application</button>
            </div>
        </div>
    </div>
</div>
@else
{{-- Approval Modal --}}
<div class="modal fade" id="approvalModal" tabindex="-1" role="dialog" aria-labelledby="approvalModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="approvalModalTitle">Leave Approval Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Confirm approval for this leave?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No, go back</button>
                <button type="button" class="btn btn-success">Confirm Approval</button>
            </div>
        </div>
    </div>
</div>
{{-- Rejection Modal --}}
<div class="modal fade" id="rejectionModal" tabindex="-1" role="dialog" aria-labelledby="rejectionModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectionModalTitle">Leave Rejection Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="remarks">Remarks</label>
                    <textarea class="form-control" id="remarks" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No, go back</button>
                <button type="button" class="btn btn-danger">Confirm Rejection</button>
            </div>
        </div>
    </div>
</div>
@if($details['leaveStatus'] == "PENDING")
{{-- Meet Student Modal --}}
<div class="modal fade" id="meetStudentModal" tabindex="-1" role="dialog" aria-labelledby="meetStudentModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="meetStudentModalTitle">Meet Student Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="remarks">Remarks</label>
                    <textarea class="form-control" id="remarks" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No, go back</button>
                <button type="button" class="btn btn-warning">Send Request</button>
            </div>
        </div>
    </div>
</div>
@endif
@endif
@endif
<div class="container">
    <div class="row my-4">
        <h3 class="col-8">STATUS DETAILS ({{$details['leaveStatus']}})</h3>
        <div class="col-md-4 d-flex justify-content-md-end">
            {{-- userRole will probably be removed when proper authentication is setup --}}
            @if ($details['leaveStatus'] != "APPROVED" && $details['leaveStatus'] != "REJECTED")
            @if ($userRole == "Student")
            <button class="btn btn-danger" data-toggle="modal" data-target="#cancellationModal">Cancel Leave</button>
            @else
            <div class="btn-group" role="group" aria-label="Review Leave Actions">
                <button class="btn btn-success" data-toggle="modal" data-target="#approvalModal">Approve</button>
                @if($details['leaveStatus'] == "PENDING")
                <button class="btn btn-warning" data-toggle="modal" data-target="#meetStudentModal">Meet
                    Student</button>
                @endif
                <button class="btn btn-danger" data-toggle="modal" data-target="#rejectionModal">Reject</button>
            </div>
            @endif
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col-md-4 col-lg-3 pr-0">Leave ID:</div>
                <div class="col pl-md-0">{{$details['leaveId']}}</div>
            </div>
            <div class="row">
                <div class="col-md-4 col-lg-3 pr-0">Name:</div>
                <div class="col pl-md-0">{{$details['studentName']}}</div>
            </div>
            <div class="row">
                <div class="col-md-4 col-lg-3 pr-0">Session:</div>
                <div class="col pl-md-0">{{$details['session']}}</div>
            </div>
            <div class="row">
                <div class="col-md-4 col-lg-3 pr-0">Contact No:</div>
                <div class="col pl-md-0">{{$details['contact']}}</div>
            </div>
            <div class="row">
                <div class="col-md-4 col-lg-3 pr-0">Address:</div>
                <div class="col pl-md-0">{{$details['address']}}</div>
            </div>
        </div>
        <div class="col">
            <div class="row">
                <div class="col-md-4 px-0">Matriculation No:</div>
                <div class="col pl-0">{{$details['studentMatricId']}}</div>
            </div>
            <div class="row">
                <div class="col-md-4 px-0">IC/Passport No:</div>
                <div class="col pl-0">{{$details['studentId']}}</div>
            </div>
            <div class="row">
                <div class="col-md-4 px-0">Programme:</div>
                <div class="col pl-0">{{$details['programme']}}</div>
            </div>
        </div>
    </div>
    <div class="row my-5">
        <div class="col">
            <div class="card">
                <div class="card-header"><span class="ml-4">LEAVE DETAILS</span></div>
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between">
                        <span class="ml-4">Leave Type</span>
                        <span>{{$details['leaveType']}}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between">
                        <span class="ml-4">Absent Period</span>
                        <span>{{$details['leavePeriod']}}</span>
                    </div>
                    <div class="list-group-item">
                        <div class="row collapsed" data-toggle="collapse" data-target="#collapseReason"
                            aria-expanded="false" aria-controls="collapseReason">
                            <div class="col-auto pr-2">
                                <span class="chevron"></span>
                            </div>
                            <span class="col p-0">Reasons</span>
                        </div>
                        <div class="collapse" id="collapseReason">
                            <p class="mt-1 ml-4">{{$details['reason']}}</p>
                        </div>
                    </div>
                    <div class="list-group-item container">
                        <div class="row collapsed" data-toggle="collapse" data-target="#collapseDocuments"
                            aria-expanded="false" aria-controls="collapseDocuments">
                            <div class="col-auto pr-2">
                                <span class="chevron"></span>
                            </div>
                            <span class="col p-0">Supporting Documents</span>
                        </div>
                        <div class="collapse" id="collapseDocuments">
                            <ul class="mt-1 ml-4 list-unstyled">
                                @foreach ($details['supportingDocuments'] as $documentDetails)
                                <li><a href="{{$documentDetails['link']}}">{{$documentDetails['name']}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="list-group-item container">
                        <div class="row collapsed" data-toggle="collapse" data-target="#collapseClasses"
                            aria-expanded="false" aria-controls="collapseClasses">
                            <div class="col-auto pr-2">
                                <span class="chevron"></span>
                            </div>
                            <span class="col p-0">Affected Classes</span>
                        </div>
                        <div class="collapse" id="collapseClasses">
                            <ul class="mt-1 ml-4 list-unstyled">
                                @foreach ($details['affectedClasses'] as $className)
                                <li>{{$className}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @isset ($approvalStatus)
    <div class="row my-5">
        <div class="col">
            <div class="card">
                <div class="card-header"><span class="ml-4">APPROVAL STATUS</span></div>
                <div class="list-group list-group-flush">
                    @foreach ($approvalStatus as $approvalDetails)
                    @isset ($approvalDetails['remarks'])
                    <div class="list-group-item container">
                        <div class="row collapsed" data-toggle="collapse" data-target="#collapseStatus{{$loop->index}}"
                            aria-expanded="false" aria-controls="collapseStatus{{$loop->index}}">
                            <div class="col-auto pr-2">
                                <span class="chevron"></span>
                            </div>
                            <span class="col p-0">{{$approvalDetails['approver']}}</span>
                            <span
                                class="col text-{{$approvalDetails['status'] == 'APPROVED' ? 'success' : ($approvalDetails['status'] == 'REJECTED' ? 'danger' : 'warning')}} text-right">{{$approvalDetails['status']}}</span>
                        </div>
                        {{-- The paragraph is contained within a div with the collapse class instead of immediately applying the collapse class to the paragraph to prevent jumpy collapsing caused by the margin top --}}
                        <div class="collapse" id="collapseStatus{{$loop->index}}">
                            <p class="mt-1 ml-4">{{$approvalDetails['remarks']}}</p>
                        </div>
                    </div>
                    @endisset
                    @empty($approvalDetails['remarks'])
                    <div class="list-group-item d-flex justify-content-between">
                        <span class="ml-4">{{$approvalDetails['approver']}}</span>
                        <span class="text-{{$approvalDetails['status'] == 'APPROVED' ? 'success' : ($approvalDetails['status'] == 'REJECTED' ? 'danger' : 'warning')}}
                        ">{{$approvalDetails['status']}}</span>
                    </div>
                    @endempty
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endisset
</div>
@endsection