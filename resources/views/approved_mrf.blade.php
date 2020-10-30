@extends('layouts.header')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        @foreach($approved_manpower_requests as $approved_manpower_request)
        <div class="col-lg-4">
            
            <div class="contact-box">
                <div class="row" >
                    <div class="col-9">
                        <h3> Job Title : {{$approved_manpower_request->position_info->job_title}}</h3>
                        <h5><strong>Company :</strong>  {{$approved_manpower_request->company_info->name}}</h5>
                        
                    </div>
                    <div class="col-3">
                            <a onclick='show()' href='{{url('apply-applicant/'.$approved_manpower_request->id)}}'><button class="btn btn-sm btn-primary">Apply now</button></a>
                        </div>
                    <div class="col-12">
                        <br>
                        <h5>Job Description : <br> <br>
                            {!! nl2br(e($approved_manpower_request->position_info->job_description))!!}
                        </h5><br>
                        <h5>Minimum Requirements : <br> <br>
                            <ul>
                                @foreach($approved_manpower_request->position_info->qualifications as $key => $qualification)
                                
                                <li>{{$qualification->qualification}}</li>
                                @endforeach
                            </ul>
                        </h5>
                    
                        <h5>   Job level: {{$approved_manpower_request->position_info->job_level}}</h5>
                        <h5>   Vacancy: {{$approved_manpower_request->number_of_person}}</h5>
                        <h5><strong>Site :</strong>  {{$approved_manpower_request->location_info->name}}</h5>
                        <h5><strong>Office Address :</strong> {{$approved_manpower_request->location_info->address_info->name}}</h5>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
