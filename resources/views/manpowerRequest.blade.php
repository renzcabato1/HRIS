@extends('layouts.header')

@section('content')

<div class="wrapper wrapper-content animated fadeInRight">
    @if(session()->has('status'))
    <div class="alert alert-success alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        {{session()->get('status')}}
    </div>
    @endif
    <div class="row">
        <div class="col-lg-5">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Manpower Request</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form  method='POST' action='save-manpower' onsubmit='show();'  >
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class='row'>
                                <div class='col-lg-8'>
                                    <label class="font-normal">Company <span style='color:red;'>*</span></label>
                                    <select data-placeholder="Choose Company" name='company' class="chosen-select "  required="true" tabindex="1" required>
                                        <option value=""></option>
                                        @foreach($companies as $company)
                                        <option value="{{$company->id}}">{{$company->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class='col-lg-4'>
                                    <label class="font-normal">Site <span style='color:red;'>*</span></label>
                                    <div>
                                        <select data-placeholder="Choose Site" name='location' class="chosen-select"  tabindex="2" required>
                                            <option value=""></option>
                                            @foreach($sites as $site)
                                            <option value="{{$site->id}}">{{$site->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class='row'>
                                <div class='col-lg-8'>
                                    <label class="font-normal">Department <span style='color:red;'>*</span></label>
                                    <select data-placeholder="Choose Department" name='department' class="chosen-select"  tabindex="3" required>
                                        <option value=""></option>
                                        @foreach($departments as $department)
                                        <option value="{{$department->id}}">{{$department->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class='col-lg-4'>
                                    <label class="font-normal">No. of Personnel Needed <span style='color:red;'>*</span></label>
                                    <div>
                                        <input class="touchspin1" type="text" min='1' value="1" name="personnel_needed" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class='row'>
                                <div class='col-lg-8'>
                                    <label class="font-normal">Directly Reporting to <span style='color:red;'>*</span></label>
                                    
                                    <select data-placeholder="Choose employee" name='direct_employee' class="chosen-select"  tabindex="4" required>
                                        <option value=""></option>
                                        @foreach($employeeDepartments as $employeeDepartment)
                                        <option value="{{$employeeDepartment->EmployeeView->EmployeeUser->id}}" {{($employeeDepartment->EmployeeView->EmployeeUser->id == auth()->user()->id) ? "selected":"" }}>{{$employeeDepartment->EmployeeView->EmployeeUser->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class='col-lg-4'>
                                    <label class="font-normal">Cost Center <span style='color:red;'>*</span></label>
                                    
                                    <input type="text" placeholder="Cost Center" name='cost_center' class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div >
                                <label class="font-normal">Position Title <span style='color:red;'>*</span></label>
                                <select class="chosen-select" name='position_id' data-placeholder="Choose position"   required>
                                    <option></option>
                                    @foreach($jobs as $job)
                                    <option value='{{$job->id}}'>{{$job->job_title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <div >
                                <label class="font-normal">Job Description</label>
                                <textarea type="text" placeholder="Job Description" style='min-height:150px;' class="form-control"></textarea>
                            </div>
                        </div> --}}
                        <div class="form-group">
                            <div class='row'>
                                <div class='col-lg-3'>
                                    <label class="font-normal">Type of Hiring <span style='color:red;'>*</span></label><br>
                                    <div class="radio radio-success">
                                        <input type="radio" name="typeHiring" id="external" value="external"  required>
                                        <label for="external">
                                            External
                                        </label>
                                    </div>
                                    <div class="radio radio-success">
                                        <input type="radio" name="typeHiring" id="internal" value="internal" required>
                                        <label for="internal">
                                            Internal
                                        </label>
                                    </div>
                                </div>
                                <div class='col-lg-5 requisition'>
                                    <label class="font-normal">Type of Requisition <span style='color:red;'>*</span></label><br>
                                    <div class="radio radio-success">
                                        <input type="radio" name="typeOfRequisition" id="replacement" onclick='requisition(value)' value="replacement"  required>
                                        <label for="replacement">
                                            Replacement
                                        </label>
                                    </div>
                                    <div class="radio radio-success">
                                        <input type="radio" name="typeOfRequisition" id="additional" onclick='requisition(value)' value="additional" required>
                                        <label for="additional">
                                            Additional
                                        </label>
                                    </div>
                                </div>
                                <div class='col-lg-4 statusEmployee'>
                                    <label class="font-normal">Status of Employment <span style='color:red;'>*</span></label><br>
                                    <div class="radio radio-success">
                                        <input type="radio" name="status_of_employment" id="permanent"  onclick='statusOfEmployement(value)'  value="permanent"  required>
                                        <label for="permanent">
                                            Permanent
                                        </label>
                                    </div>
                                    <div class="radio radio-success">
                                        <input type="radio" name="status_of_employment" id="projectBased" onclick='statusOfEmployement(value)' value="projectBased" required>
                                        <label for="projectBased">
                                            Project-based
                                        </label>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class='row'>
                                <div class='col-lg-6'>
                                    <label class="font-normal">Immediate Manager <span style='color:red;'>*</span></label>
                                    
                                    <select data-placeholder="Choose employee" name='immediate_manager' class="chosen-select"  tabindex="4" required>
                                        <option value=""></option>
                                        @foreach($employees as $employee)
                                        <option value="{{$employee->user_id}}" >{{$employee->first_name.' '.$employee->last_name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class='col-lg-6'>
                                    <label class="font-normal">Department Head <span style='color:red;'>*</span></label>
                                    
                                    <select data-placeholder="Choose employee" name='department_head' class="chosen-select"  tabindex="4" required>
                                        <option value=""></option>
                                        @foreach($employees as $employee)
                                        <option value="{{$employee->user_id}}" >{{$employee->first_name.' '.$employee->last_name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class='row'>
                                <div class='col-lg-6'>
                                    <label class="font-normal">Finance Manager / CFO <span style='color:red;'>*</span></label>
                                    <select data-placeholder="Choose employee" name='finance_manager' class="chosen-select"  tabindex="4" required>
                                        <option value=""></option>
                                        @foreach($employees as $employee)
                                        <option value="{{$employee->user_id}}" >{{$employee->first_name.' '.$employee->last_name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class='row'>
                                <div class='col-lg-6'>
                                    <label class="font-normal">HR Operations <span style='color:red;'>*</span></label>
                                    
                                    <select data-placeholder="Choose employee" name='hr_operation' class="chosen-select"  tabindex="4" required>
                                        <option value=""></option>
                                        @foreach($employees as $employee)
                                        <option value="{{$employee->user_id}}" >{{$employee->first_name.' '.$employee->last_name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class='col-lg-6'>
                                    <label class="font-normal">Human Resouces Head <span style='color:red;'>*</span></label>
                                    <select data-placeholder="Choose employee" name='hr_head' class="chosen-select"  tabindex="4" required>
                                        <option value=""></option>
                                        @foreach($employees as $employee)
                                        <option value="{{$employee->user_id}}" >{{$employee->first_name.' '.$employee->last_name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <button class="btn btn-primary " type="submit"><i class="fa fa-check"></i>&nbsp;Submit</button>
                            </div>
                        </div>
                    </form>
                    {{-- <div class="form-group">
                        
                        <p class="text-danger"><b>***Please attach required documents: Job Description, Org Chart and Copy of Resignation Letter (if applicable)***</b></p>
                        <div class="custom-file">
                            <input id="logo" type="file" placeholder='Uploadfile' class="custom-file-input" multiple>
                            <label for="logo" class="custom-file-label selected">Please Upload File</label>
                        </div>
                    </div> --}}
                    {{-- <div class="form-group">
                        <div >
                            <label class="font-normal">Minimum Qualifications</label>
                            <textarea placeholder="Minimum Qualifications" style='min-height:150px;' class="form-control"></textarea>
                        </div>
                    </div> --}}
                    
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="panel blank-panel">
                <div class="panel-heading">
                    <div class="panel-options">
                        <ul class="nav nav-tabs">
                            <li><a    @if(session()->has('approve')) class="nav-link"  @else class="nav-link active" @endif href="#tab-1" data-toggle="tab" >Pending Request ({{count($manpowers)}})</a></li>
                            <li><a @if(session()->has('approve')) class="nav-link active"   @else class="nav-link" @endif href="#tab-2" data-toggle="tab" >For Approval({{count($for_approval)}})</a></li>
                            <li><a class="nav-link " href="#tab-3" data-toggle="tab" >Approved MRF({{count($approved_manpower_requests)}})</a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div  @if(session()->has('approve')) class="tab-pane" @else class="tab-pane active" @endif   id="tab-1">
                            <div class="ibox ">
                                <div class="ibox-title">
                                    <h5>Manpower Request</h5>
                                    <div class="ibox-tools">
                                        <a class="collapse-link">
                                            <i class="fa fa-chevron-up"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="ibox-content table-responsive">
                                    <table id='manpower-datatable' class="table table-hover no-margins ">
                                        <thead>
                                            <tr>
                                                <th>Requestor</th>
                                                <th>Company</th>
                                                <th>Site</th>
                                                <th>Position</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($manpowers as $manpower)
                                            <tr onclick='viewManpowerRequest({{$manpower->id}})'>
                                                <td>{{$manpower->request_info->name}}
                                                </td>
                                                <td>{{$manpower->company_info->name}}
                                                </td>
                                                <td>{{$manpower->location_info->name}}
                                                </td>
                                                <td>{{$manpower->position_info->job_title}}
                                                </td>
                                                <td>{{$manpower->status}}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div  @if(session()->has('approve')) class="tab-pane active" @else class="tab-pane" @endif  id="tab-2">
                            <div class="ibox ">
                                <div class="ibox-title">
                                    <h5>For Approval</h5>
                                    <div class="ibox-tools">
                                        <a class="collapse-link">
                                            <i class="fa fa-chevron-up"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="ibox-content table-responsive">
                                    <table id='manpower-datatable-for-approval' class="table table-hover no-margins ">
                                        <thead>
                                            <tr>
                                                <th>Requestor</th>
                                                <th>Type</th>
                                                <th>Approver</th>
                                                <th>Position</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($for_approval as $for_App) 
                                            <tr>
                                                <td>{{$for_App->manpower_infor->request_info->name}}</td>
                                                <td>{{$for_App->type}}</td>
                                                <td>{{$for_App->user_info->name}}</td>
                                                <td>{{$for_App->manpower_infor->position_info->job_title}}</td>
                                                <td>
                                                     <a onclick='viewManpowerRequest({{$for_App->manpower_infor->id}})' data-target="#assign_account" data-toggle="modal" type="button"><i title='View Request' class="fa fa-id-card"></i></a><br>
                                                <a  data-target="#forapproval{{$for_App->id}}" data-toggle="modal" type="button" title='verify'> ✓</a>
                                                    </td>
                                            </tr>
                                            @include('for_approval_manpower')
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                        <div class="tab-pane" id="tab-3">
                            <div class="ibox ">
                                <div class="ibox-title">
                                    <h5>Approved</h5>
                                    <div class="ibox-tools">
                                        <a class="collapse-link">
                                            <i class="fa fa-chevron-up"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="ibox-content table-responsive">
                                    <table id='manpower-datatable-approved-manpower' class="table table-hover no-margins ">
                                        <thead>
                                            <tr>
                                                <th>Requestor</th>
                                                <th>Company</th>
                                                <th>Site</th>
                                                <th>Position</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($approved_manpower_requests as $approved_manpower_request)
                                                <tr onclick='viewManpowerRequest({{$approved_manpower_request->id}})'>
                                                    <td>{{$approved_manpower_request->request_info->name}}
                                                    </td>
                                                    <td>{{$approved_manpower_request->company_info->name}}
                                                    </td>
                                                    <td>{{$approved_manpower_request->location_info->name}}
                                                    </td>
                                                    <td>{{$approved_manpower_request->position_info->job_title}}
                                                    </td>
                                                    <td>{{$approved_manpower_request->status}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('view_manpower_request')
<script>
    function requisition(request)
    {
        if(request == "replacement")
        {
            var myEle = document.getElementById("replacementEmp");
            if(myEle == null) { 
                $("#reason").remove();
                
                $(".requisition").append('<select id="replacementEmp" data-placeholder="Choose employee" name="replacementEmployee" class="chosen-select"  tabindex="4" required><option value=""></option>@foreach($employeeDepartments as $employeeDepartment)<option value="{{$employeeDepartment->EmployeeView->EmployeeUser->id}}" >{{$employeeDepartment->EmployeeView->EmployeeUser->name}}</option>@endforeach</select>'); //add input box
                $('<link/>', {
                    rel: 'stylesheet',
                    type: 'text/css',
                    href: '{{ asset('bootstrap/css/plugins/chosen/bootstrap-chosen.css') }}'
                }).appendTo('head');
                var chosen_js = '{{ asset('bootstrap/js/plugins/chosen/chosen.jquery.js') }}';        
                $.getScript(chosen_js,function(jd) {
                    $('.chosen-select').chosen({width: "100%"});
                });     
            }     
        }
        else
        {
            var myEle = document.getElementById("reason");
            if(myEle == null) { 
                $("#replacementEmp").remove();
                $("#replacementEmp_chosen").remove();
                $(".requisition").append('<textarea id="reason" placeholder="Reason" name="reason" class="form-control" required></textarea>'); //add input box
                
            }
        }
    }
    function statusOfEmployement(status)
    {
        
        if(status == "permanent")
        {
            
            $("#statusMonths").remove();
            $(".statusEmployee .bootstrap-touchspin").remove();
        }
        else
        {
            var statusId = document.getElementById("statusMonths");
            if(statusId == null) { 
                $(".statusEmployee").append('<input id="statusMonths" class="statusMonth" type="text" value="6" name="status_month" required>');
                $('<link/>', {
                    rel: 'stylesheet',
                    type: 'text/css',
                    href: '{{ asset('bootstrap/css/plugins/chosen/bootstrap-chosen.css') }}'
                }).appendTo('head');
                var chosen_js = '{{ asset('bootstrap/js/plugins/touchspin/jquery.bootstrap-touchspin.min.js') }}';        
                $.getScript(chosen_js,function(jd) {
                    $('.chosen-select').chosen({width: "100%"});
                });  
                $(".statusMonth").TouchSpin({
                    min: 6,
                    max: 100,
                    maxboostedstep: 10,
                    postfix: '<h6>months</h6>',
                    buttondown_class: 'btn btn-white',
                    buttonup_class: 'btn btn-white'
                });
            }
        }
    }
    function nl2br (str, is_xhtml)
    {   
        var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br>' : '<br>';    
        return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
    }
    function viewManpowerRequest(id)
    {   
        $("#view_manpower").modal();
        document.getElementById("myDiv").style.display="block";
        $.ajax(
        {  //create an ajax request to load_page.php
            type: "GET",
            url: "{{ url('/get-manpower') }}",            
            data:
            {
                "manpowerId" : id,
            }     ,
            dataType: "json",   //expect html to be returned
            success: function(data)
            {
                console.log(data);
                document.getElementById("company_view").textContent=data.company_info.name;
                document.getElementById("site_view").textContent=data.location_info.name;
                document.getElementById("department_view").textContent=data.department_info.name;
                document.getElementById("personnel_needed").textContent=data.number_of_person;
                document.getElementById("reporting_to").textContent=data.reporting_to_info.name;
                document.getElementById("cost_center").textContent=data.cost_center;
                document.getElementById("job_title").textContent=data.position_info.job_title;
                document.getElementById("job_description").innerHTML = nl2br(data.position_info.job_description);
                document.getElementById("type_of_hiring").innerHTML = data.type_of_hiring;
                document.getElementById("type_of_requisition").innerHTML = data.type_of_requisition;
                $("#project_months").remove();
                $("#requisition_content").remove();
                if(data.type_of_requisition == 'replacement')
                { 
                    var type_of_request = "<span id='requisition_content'>Replacement of : "+data.replacement_info.name+"</span>";
                    $(".type_of_requisition").append(type_of_request);
                }
                else
                {
                    var type_of_request = "<span id='requisition_content'>Reason : "+data.additional_reason+"</span>";
                    $(".type_of_requisition").append(type_of_request);
                }
                if(data.status_of_employment == 'projectBased')
                {
                    var type_of_request = "<span id='project_months'>Months : "+data.project_based+"</span>";
                    $(".type_of_requisition").append(type_of_request);
                }
                document.getElementById("status_of_employment").innerHTML = data.status_of_employment;
                $('.table-approver').children().remove();
                var tableApprover = "<div class='col-lg-4 border'>Type</div><div class='col-lg-4 border'>Signatory</div><div class='col-lg-4 border'>Status</div>";
                jQuery.each(data.manpower_approver, function(dataid) {
                //   alert(data.manpower_approver[dataid].type);
                  
                    tableApprover += "<div class='col-lg-4 border'>"+data.manpower_approver[dataid].type+"</div>";
                    tableApprover += "<div class='col-lg-4 border'>"+data.manpower_approver[dataid].user_info.name+"</div>";

                    if(data.manpower_approver[dataid].date_verified == null)
                    {
                        tableApprover += "<div class='col-lg-4 border'><span class='badge badge-danger response'>No Response</span></div>";
                    }
                    else
                    {
                        tableApprover += "<div class='col-lg-4 border'><span class='badge badge badge-primary response'>Verified</span> <br> Date Verified :"+data.manpower_approver[dataid].date_verified+" <br> Remarks: "+data.manpower_approver[dataid].remarks+"";
                        if(data.manpower_approver[dataid].type == "Finance Manager")
                        {
                            tableApprover += "<br>Budget: "+data.manpower_approver[dataid].budget+"</div>";
                        }
                        else
                        {
                            tableApprover += "</div>";
                        }
                    }
                    
                
                });
            
                $(".table-approver").append(tableApprover);
                // document.getElementById("immediate_manager_show").innerHTML = data.manager_info.name;
                // document.getElementById("department_head_show").innerHTML = data.department_head_info.name;
                // document.getElementById("finance_manager").innerHTML = data.finance_manager_info.name;
                // document.getElementById("hr_operation").innerHTML = data.hr_operation_info.name;
                // document.getElementById("hr_head").innerHTML = data.hr_head_info.name;
                // $(".response").remove();
                // if(data.for_approval <= 1)
                // {
                //     $("#immediate_manager_status").append("<span class='badge badge-danger response'>No Response</span>");
                //     $("#department_head_status").append("<span class='badge badge-danger response'>No Response</span>");
                //     $("#finance_manager_status").append("<span class='badge badge-danger response'>No Response</span>");
                //     $("#hr_operation_status").append("<span class='badge badge-danger response'>No Response</span>");
                //     $("#hr_head_status").append("<span class='badge badge-danger response'>No Response</span>");
                // }
                // else if(data.for_approval <= 2)
                // {
                //     $("#immediate_manager_status").append("<span class='badge badge badge-primary response'>Approved</span>");
                //     $("#department_head_status").append("<span class='badge badge-danger response'>No Response</span>");
                //     $("#finance_manager_status").append("<span class='badge badge-danger response'>No Response</span>");
                //     $("#hr_operation_status").append("<span class='badge badge-danger response'>No Response</span>");
                //     $("#hr_head_status").append("<span class='badge badge-danger response'>No Response</span>");
                // }
                // else if(data.for_approval <= 3)
                // {
                //     $("#immediate_manager_status").append("<span class='badge badge badge-primary response'>Approved</span>");
                //     $("#department_head_status").append("<span class='badge badge badge-primary response'>Approved</span>");
                //     $("#finance_manager_status").append("<span class='badge badge-danger response'>No Response</span>");
                //     $("#hr_operation_status").append("<span class='badge badge-danger response'>No Response</span>");
                //     $("#hr_head_status").append("<span class='badge badge-danger response'>No Response</span>");
                // }
                // else if(data.for_approval <= 4)
                // {
                //     $("#immediate_manager_status").append("<span class='badge badge badge-primary response'>Approved</span>");
                //     $("#department_head_status").append("<span class='badge badge badge-primary response'>Approved</span>");
                //     $("#finance_manager_status").append("<span class='badge badge badge-primary response'>Approved</span>");
                //     $("#hr_operation_status").append("<span class='badge badge-danger response'>No Response</span>");
                //     $("#hr_head_status").append("<span class='badge badge-danger response'>No Response</span>");
                // }
                // else if(data.for_approval <= 5)
                // {
                //     $("#immediate_manager_status").append("<span class='badge badge badge-primary response'>Approved</span>");
                //     $("#department_head_status").append("<span class='badge badge badge-primary response'>Approved</span>");
                //     $("#finance_manager_status").append("<span class='badge badge badge-primary response'>Approved</span>");
                //     $("#hr_operation_status").append("<span class='badge badge badge-primary response'>Approved</span>");
                //     $("#hr_head_status").append("<span class='badge badge-danger response'>No Response</span>");
                    
                // }
                // else if(data.for_approval == 6)
                // {
                //     $("#immediate_manager_status").append("<span class='badge badge badge-primary response'>Approved</span>");
                //     $("#department_head_status").append("<span class='badge badge badge-primary response'>Approved</span>");
                //     $("#finance_manager_status").append("<span class='badge badge badge-primary response'>Approved</span>");
                //     $("#hr_operation_status").append("<span class='badge badge badge-primary response'>Approved</span>");
                //     $("#hr_head_status").append("<span class='badge badge badge-primary response'>Approved</span>");
                    
                // }
                
                $('.job_requirements').children().remove();
                if(data.position_info.qualifications != null)
                {
                    jQuery.each(data.position_info.qualifications, function(idJob) {
                        var idrequirements = idJob+1;
                        var job_requirements = "<div>"+idrequirements+". "+ data.position_info.qualifications[idJob].qualification +"</div>";
                        
                        $(".job_requirements").append(job_requirements);
                        
                    });
                }
                document.getElementById("myDiv").style.display="none";
            }
            ,
            error: function(e)
            {
                console.log(e);
                document.getElementById("myDiv").style.display="none";
            }
        }
        );
    }
</script>
@endsection
