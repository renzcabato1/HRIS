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
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>For Interview</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content table-responsive">
                    <table id='manpower-datatable-1' class="table table-hover no-margins ">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Status</th>
                                <th>Schedule</th>
                                <th>Remarks</th>
                                <th>Interviewer</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                function ordinal($number) 
                                {
                                    $ends = array('th','st','nd','rd','th','th','th','th','th','th');
                                    if ((($number % 100) >= 11) && (($number%100) <= 13))
                                        return $number. 'th';
                                    else
                                        return $number. $ends[$number % 10];
                                }
                            @endphp
                            @foreach($for_interviews as $applicant)
                                <tr>
                                    <td>
                                        
                                        <img alt="image" class="rounded-circle m-t-xs img-sm" src="{{URL::asset($applicant->applicant_info->avatar)}}" height='100px;' width='100px;' onerror="this.src='{{URL::asset('/images/no_image.png')}}';" >
                                        {{$applicant->applicant_info->first_name." ".$applicant->applicant_info->last_name}}</td>
                                    <td>{{$applicant->position}}</td>
                                    <td>{{ordinal($applicant->interview_number)}} Interview</td>
                                    <td>{{date('M. d, Y',strtotime($applicant->date_scheduled))}} {{date('H:i a',strtotime($applicant->time_scheduled))}}</td>
                                    <td>{{$applicant->remarks}}</td>
                                    <td>@foreach ($applicant->applicant_history_interviewer as $interviewer) @if($applicant->interview_number == $interviewer->interview_number) {{$interviewer->interviewer_info->name}} <br> @endif @endforeach</td>
                                    <td>
                                        <button class="btn btn-sm btn-danger" onclick="showModal({{$applicant->id}})">View Profile</button> <Br>
                                        <button class="btn btn-sm btn-primary" onclick="proceed_applicant({{$applicant->id}})" >Proceed</button> <Br>
                                        <button class="btn btn-sm btn-info">For Requirements</button> <Br>
                                        <button class="btn btn-sm btn-warning">Reject</button>
                                    </td>
                                </tr>
                                @include('proceed_next_interview')
                                @include('view_applicant_proceed')
                            @endforeach
                        </tbody>
                    </table>
                    <script>
                        function showModal(ApplicantID)
                        {
                            $("#view_applicant_proceed"+ApplicantID).modal();
                        }
                        function proceed_applicant(ApplicantID)
                        {
                            $("#proceed_interivew"+ApplicantID).modal();
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
