<div class="modal fade" id="view_applicant_proceed{{$applicant->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class='col-md-10'>
                    <h5 class="modal-title" id="exampleModalLabel">View Applicant</h5>
                </div>
                <div class='col-md-2'>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row border" >
                        <div class="col-12 text-center">
                          Logs
                        </div>
                      
                    </div>
                    <div class="row border" >
                        <div class="col-2 border">
                           Action By
                        </div>
                        <div class="col-2 border">
                           Action Made
                        </div>
                        <div class="col-2 border">
                            Scheduled
                        </div>
                        <div class="col-2 border">
                            Remarks
                        </div>
                        <div class="col-2 border">
                            Attachment
                        </div>
                        <div class="col-2 border">
                            Date Created
                        </div>
                    </div>
                    @foreach($applicant->applicant_history as $history)
                        <div class="row border" >
                            <div class="col-2 border">
                                {{$history->user_info->name}}
                            </div>
                            <div class="col-2 border">
                                {{$history->action_made}}
                            </div>
                            <div class="col-2 border">
                                {{date('M. d, Y',strtotime($history->date_scheduled))}} {{date('H:i a',strtotime($history->time_scheduled))}}
                            </div>
                            <div class="col-2 border">
                                {{$history->remarks}}
                            </div>
                            <div class="col-2 border">
                                @if($history->attachment)
                                <a href = "{{ asset(''.$history->attachment.'')}}" target="_target">Attachment</a>
                                @else
                                No Attachment
                                @endif
                            </div>
                            <div class="col-2 border">
                                {{date('M. d, Y',strtotime($history->created_at))}}
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row border" >
                    <div class="col-12 text-center">
                      Profile
                    </div>
                </div>
                <div class="form-group">
                    <div class="row" >
                        <div class="col-12">
                            <div class="text-center">
                                <img alt="image" class="rounded-circle m-t-xs img-fluid" src="{{URL::asset($applicant->applicant_info->avatar)}}" height='100px;' width='100px;' onerror="this.src='{{URL::asset('/images/no_image.png')}}';" >
                                <a href='{{url($applicant->applicant_info->resume)}}' target='_'><div class="m-t-xs font-bold">View/Download Resume</div></a>
                            </div>
                        </div>
                    </div>
                </div>
           
                <h2> <b>Account Information </b> </h2>
                <hr>
                <div class="form-group ">
                    <div class='row'>
                        <div class='col-lg-12'>
                            <label class="font-normal">Name : {{$applicant->applicant_info->first_name}} {{$applicant->applicant_info->last_name}}</label> 
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-6'>
                            <label class="font-normal">Email : {{$applicant->applicant_info->personal_email}} </label> 
                        </div>
                        <div class='col-lg-6'>
                            <label class="font-normal">Phone Number : {{$applicant->applicant_info->phone}} </label> 
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-6'>
                            <label class="font-normal">Marital Status : {{$applicant->applicant_info->marital_status}} </label> 
                        </div>
                        <div class='col-lg-6'>
                            <label class="font-normal">Gender : {{$applicant->applicant_info->gender}} </label> 
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-12'>
                            <label class="font-normal">Address : {{$applicant->applicant_info->street_address}} </label> 
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-6'>
                            <label class="font-normal">Birthdate : {{date('F d, Y',strtotime($applicant->applicant_info->birthdate))}} </label> 
                        </div>
                        @php
                        $diff = strtotime(date('Y-m-d'))-strtotime($applicant->applicant_info->birthdate);
                        $year = floor($diff/ (365*60*60*24));
                        $months = floor(($diff - $year * 365*60*60*24) / (30*60*60*24));
                        @endphp
                        <div class='col-lg-6'>
                            <label class="font-normal">Age :   {{$year . ' Year/s and '. $months .' Month/s'}}</label> 
                        </div>
                    </div>
                </div>
                <hr>
                <h2 ><b>Work experience</b> </h2>
                @if(count($applicant->applicant_info->work_experience_info))
                @foreach($applicant->applicant_info->work_experience_info as $work_experience)
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
                @else
                <hr>
                <h4><i>No employment history</i></h4>
                @endif
                <hr>
                <h2 ><b>Education Background</b> </h2>
                @if(count($applicant->applicant_info->education_info))
                @foreach($applicant->applicant_info->education_info as $education)
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
                <hr>
                <h4><i>No data found</i></h4>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                {{-- <a><button type="submit" onclick='show()'  class="btn btn-primary" >Cancel</button></a> --}}
            </div>
        </div>
    </div>
</div>
