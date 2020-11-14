@extends('layout.layout')

@section('title', 'Leave Application')

@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/css/tempusdominus-bootstrap-4.min.css" integrity="sha512-PMjWzHVtwxdq7m7GIxBot5vdxUY+5aKP9wpKtvnNBZrVv1srI8tU6xvFMzG8crLNcMj/8Xl/WWmo/oAP/40p1g==" crossorigin="anonymous" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet"/>
    
    <style>
        .fa-plus {
            cursor: pointer
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row my-4">
        <h3 class="col">LEAVE APPLICATION</h3>
    </div>
<form action="{{route('ApplicationConfirmation')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <div class="col-md-6">
                {{--Leave Type Selection--}}
                <div class="row">
                    <div class="col">
                        <label for="leaveType" class="mr-sm-2">Leave type:</label>
                        <select class="form-control mb-2 mr-sm-2" id="select" name="leaveType" required>
                            <option>Medical Leave</option>
                            <option>Official Leave</option>
                            <option>Bereavement Leave</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    {{--Leave Duration Selection--}}
                    <label for="dateOfAbsence" class="mr-sm-2 col-12">Date of Absence:</label>
                    <div class="input-group date col" id="datetimepicker1" data-target-input="nearest">
                        <input name="startDate" id="dateOfAbsence" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1" placeholder="From" required/>
                        <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    <div class="input-group date col" id="datetimepicker2" data-target-input="nearest">
                        <input name="endDate" id="dateOfAbsence" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker2" placeholder="To" required/>
                        <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            {{--Leave Reason--}}
            <div class="col-md-6">
                <label for="comment">Reason:</label>
                <textarea name="reason" class="form-control" rows="5" id="comment" required></textarea>
                <div class ="valid-feedback">Valid</div>
                <div class="invalid-feedback">Please fill out this field</div>
            </div>
        </div>
        <div class="form-group row">
            {{--SUPPORTING DOCUMENT--}}
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" id="supportingDocuments">
                        <span>SUPPORTING DOCUMENTS</span>
                        <i class="fa fa-plus fa-lg mt-1 float-right" onclick="iconOnClick()"></i>
                    </div>
                    <ul class="list-group list-group-flush" id="file-list"></ul>
                </div>
            </div>
        </div>
        {{--SUBMIT BUTTON--}}
        <div class="row my-4">
            <div class="col d-flex align-items-end justify-content-end">
                <button type="submit" class="btn btn-success" href="#">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/js/tempusdominus-bootstrap-4.min.js" integrity="sha512-2JBCbWoMJPH+Uj7Wq5OLub8E5edWHlTM4ar/YJkZh3plwB2INhhOC3eDoqHm1Za/ZOSksrLlURLoyXVdfQXqwg==" crossorigin="anonymous"></script>
    <script>
        let fileInputId = 0;
        
        createInput();
        
        function createInput() {
            const supportingDocumentsList = document.getElementById('supportingDocuments');
            let input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*,.pdf');
            input.setAttribute('class', 'form-control d-none');
            input.setAttribute('name', 'supportingDocuments[]');
            input.setAttribute('onChange', 'addFile()');
            input.setAttribute('id', 'fileInput' + fileInputId);
            supportingDocumentsList.appendChild(input);
        }
        
        function addFile() {
            const fileInput = document.getElementById('fileInput' + fileInputId);
            const files = fileInput.files;
            if (files.length > 0) {
                const file = files[0];
                const list = document.getElementById('file-list');
                const listItem = document.createElement('li');
                listItem.setAttribute('id', "file" + fileInputId);
                listItem.setAttribute('class', 'list-group-item d-flex justify-content-between align-items-center');
                listItem.appendChild(document.createTextNode(file.name));
        
                const deleteButton = document.createElement('button');
                deleteButton.setAttribute('class', 'btn btn-danger');
                deleteButton.setAttribute('onclick', 'removeFile(' + fileInputId + ')');
                deleteButton.appendChild(document.createTextNode('Remove'));
                listItem.appendChild(deleteButton);
                list.appendChild(listItem);
                fileInputId++;
                createInput();
            }
        }
        
        function removeFile(fileId) {
            const fileInput = document.getElementById('fileInput' + fileId);
            const fileListItem = document.getElementById('file' + fileId);
            fileInput.parentElement.removeChild(fileInput);
            fileListItem.parentElement.removeChild(fileListItem);
        }
        
        function iconOnClick() {
            document.getElementById("fileInput" + fileInputId).click();
        }
        
        //DATE TIME PICKER FUNCTION
        $(function () {
            $('#datetimepicker1').datetimepicker();
            $('#datetimepicker2').datetimepicker();
        });
    </script>
@endsection