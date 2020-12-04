@extends('layout.layout')

@section('title', 'Leave Confirmation')
@section('navSection', 'leaveApplication')

@section('content')
<div class="container">
	<div class="row my-4">
		<h3 class="col-8">LEAVE CONFIRMATION</h3>
	</div>
	<form action="{{route('ApplicationConfirmation/confirm')}}">
		<div class="row my-4">
			<div class="col-md-12 pr-0">
				@if (empty($details['affectedClasses']))
				<div class="alert alert-danger">
					<strong>Fail! </strong>No affected Classes! Fail to generate leave application. <a href="#"
						onclick="history.back()" class="alert-link">Click here to go back</a>.
				</div>
				@endif
				<div class="card">
					<div class="card-header">
						<span>LEAVE DETAILS</span>
					</div>
					<div class="list-group list-group-flush">
						{{--Leave Type--}}
						<div class="list-group-item d-flex justify-content-between">
							<span>Leave Type</span>
							<span>{{$details['leaveType']}}</span>
						</div>
						{{--Absent Period--}}
						<div class="list-group-item d-flex justify-content-between">
							<span>Absent Period</span>
							<span>{{$details['leavePeriod']}}</span>
						</div>
						{{--Reason--}}
						<div class="list-group-item">
							<div>
								<span class="col p-0">Reasons</span>
							</div>
							<div>
								<p class="mt-1">{{$details['reason']}}</p>
							</div>
						</div>
						{{--Supporting Document--}}
						<div class="list-group-item">
							<div>
								<span class="col p-0">Supporting Documents</span>
							</div>
							@if(!empty($details['supportingDocuments']))
							<div>
								<ul class="mt-1 list-unstyled">
									<p class="mt-1">
										@foreach ($details['supportingDocuments'] as $documentName)
										<li><a
												href="ApplicationConfirmation/download/{{$documentName}}">{{$documentName}}</a>
										</li>
										@endforeach
									</p>
								</ul>
							</div>
							@endif
						</div>
						{{--Affected Class--}}
						<div class="list-group-item">
							<div>
								<span class="col p-0">Affected Classes</span>
							</div>
							@if(!empty($details['affectedClasses']))
							<div>
								<ul class="mt-1 list-unstyled">
									@foreach ($details['affectedClasses'] as $class)
									<li>{{$class->course_id . " " . $class->course_name}}</li>
									@endforeach
								</ul>
							</div>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row justify-content-between">
			<div class="col-md-1">
				<button type="button" class="btn btn-light" onclick="history.back()">Back</button>
			</div>
			@if (!empty($details['affectedClasses']))
			<div class="col-md-1">
				<button type="submit" class="btn btn-success ">Confirm</button>
			</div>
			@endif
		</div>
</div>
</form>

@endsection