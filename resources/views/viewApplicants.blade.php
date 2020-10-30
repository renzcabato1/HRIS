@extends('layouts.header')
@section('content')
{{-- <div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        @foreach($manpowerapplicants as $applicant)
        <div class="col-lg-4">
            <div class="contact-box">
                <div class="row">
                    <div class="col-9">
                        <button class="btn  btn-success" data-toggle="modal"  data-target="#view_applicant{{$applicant->id}}" >View</button>
                        <button class="btn  btn-primary" data-toggle="modal"  data-target="#proceed_applicant{{$applicant->id}}">Proceed</button>
                        <button class="btn  btn-danger" data-toggle="modal"  data-target="#reject_applicant{{$applicant->id}}">Reject</button>
                    </div>
                </div>
                <br>
                <div class="row" >
                    <div class="col-4">
                        <div class="text-center">
                            <img alt="image" class="rounded-circle m-t-xs img-fluid" src="{{URL::asset($applicant->applicant_info->avatar)}}" height='100px;' width='100px;' onerror="this.src='{{URL::asset('/images/no_image.png')}}';" >
                            
                        </div>
                    </div>
                    <div class="col-8">
                        <h5><strong>Name : {{$applicant->applicant_info->first_name}} {{$applicant->applicant_info->last_name}}</strong></h5>
                        <address>Position applying for: {{$applicant->manpower_info->position_info->job_title}}<br>
                            Contact Number: {{$applicant->applicant_info->phone}} <br>
                            Email: {{$applicant->applicant_info->personal_email}}<br>
                            Address: {{$applicant->applicant_info->street_address}}<br>
                            <br>
                        </address>
                    </div>
                </div>
            </div>
        </div>
        @include('view_applicant')
        @include('proceed_applicant')
        @include('reject_applicant')
        @endforeach
    </div>
</div> --}}
<div class="wrapper wrapper-content animated fadeInRight">
    @if(session()->has('status'))
    <div class="alert alert-success alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        {{session()->get('status')}}
    </div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Applicants</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content table-responsive">
                    <input type="text" class="form-control form-control-sm m-b-xs" id="filter"
                    placeholder="Search in table">
                    <table id='' class="footable table table-hover no-margins " data-page-size="8" data-filter=#filter>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Marital Status</th>
                                <th>Personal Email</th>
                                <th>Gender</th>
                                <th>Age</th>
                                <th>Phone</th>
                                <th data-hide="all">Religion</th>
                                <th data-hide="all">Present Address</th>
                                <th data-hide="all">Permanent Address</th>
                                <th data-hide="all">Hobbies</th>
                                <th data-hide="all">Work Experience</th>
                                <th data-hide="all">Educational Background</th>
                                <th data-hide="all">Resume</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($applicants as $applicant)
                            <tr>
                                <td> <img alt="image" class="rounded-circle m-t-xs img-sm" src="{{URL::asset($applicant->avatar)}}" height='100px;' width='100px;' onerror="this.src='{{URL::asset('/images/no_image.png')}}';" >
                                    {{$applicant->first_name." ".$applicant->last_name}}</td>
                                <td>{{$applicant->marital_status}}</td>
                                <td>{{$applicant->personal_email}}</td>
                                <td>{{$applicant->gender}}</td>
                                @php
                                    $diff = strtotime(date('Y-m-d'))-strtotime($applicant->birthdate);
                                    $year = floor($diff/ (365*60*60*24));
                                    $months = floor(($diff - $year * 365*60*60*24) / (30*60*60*24));
                                
                                @endphp
                                <td> {{date('M. d, Y',strtotime($applicant->birthdate))}}({{$year}})</td>
                                <td>{{$applicant->phone}}</td>
                                <td>{{$applicant->religion}}</td>
                                <td>{{$applicant->permanent_address}}</td>
                                <td>{{$applicant->street_address}}</td>
                                <td>{{$applicant->hobbies}}</td>
                                <td>
                                    @if(count($applicant->work_experience_info)) 
                                    @foreach($applicant->work_experience_info as $work_experience)
                                    <hr>
                                    <div class="form-group ">
                                        <div class='row'>
                                            <div class='col-lg-12'>
                                                <label class="font-normal">Job Title : {{$work_experience->job_title}}</label> 
                                            </div>
                                            <div class='col-lg-12'>
                                                <label class="font-normal">Company :  {{$work_experience->company}}</label> 
                                            </div>
                                        </div>
                                        <div class='row'>
                                            <div class='col-lg-6'>
                                                <label class="font-normal">Duration :  {{date('F Y',strtotime($work_experience->from_year."-".$work_experience->from_month."-01"))}} - {{date('F Y',strtotime($work_experience->to_year."-".$work_experience->to_month."-01"))}} </label> 
                                            </div>
                                        </div>
                                        <div class='row'>
                                            <div class='col-lg-6'>
                                                <label class="font-normal">Job Level : {{$work_experience->job_level}} </label> 
                                            </div>
                                            <div class='col-lg-6'>
                                                <label class="font-normal">Job Function : {{$work_experience->job_function}} </label> 
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    
                                    @else <i>No employment history</i> 

                                    @endif
                                </td>
                                <td> 
                                    
                                    @if(count($applicant->education_info)) 
                                    @foreach($applicant->education_info as $education)
                                        <hr>
                                        <div class="form-group ">
                                            <div class='row'>
                                                <div class='col-lg-12'>
                                                    <label class="font-normal">Degree : {{$education->educational_attainment}}</label> 
                                                </div>
                                                <div class='col-lg-12'>
                                                    <label class="font-normal">Course :  {{$education->course}}</label> 
                                                </div>
                                                <div class='col-lg-12'>
                                                    <label class="font-normal">School :  {{$education->school}}</label> 
                                                </div>
                                            </div>
                                            <div class='row'>
                                                <div class='col-lg-6'>
                                                    <label class="font-normal">Duration :  {{date('F Y',strtotime($education->start_year."-".$education->start_month."-01"))}} - {{date('F Y',strtotime($education->end_year."-".$education->end_month."-01"))}} </label> 
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    @else 

                                    <i>No data found</i>
                                    @endif
                                </td>

                                <td><a href='{{url($applicant->resume)}}' target='_'><div class="m-t-xs font-bold">View/Download Resume</div></a></td>
                                <td>
                                    <button class="btn  btn-primary" data-toggle="modal"  data-target="#proceed_applicant{{$applicant->id}}">Set Schedule</button>
                                    {{-- <button class="btn  btn-danger" data-toggle="modal"  data-target="#reject_applicant{{$applicant->id}}">Reject</button> --}}
                                </td>
                                
                            </tr>
                            @include('proceed_applicant')
                            @include('reject_applicant')
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
