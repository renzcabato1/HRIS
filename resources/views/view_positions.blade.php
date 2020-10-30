@extends('layouts.header')
@section('content')
<div class="wrapper wrapper-content">
        <div class='row'>
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Positions</h5>   <button class="btn btn-success " data-toggle="modal" data-target="#new_position" data-toggle="new_position" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold">New Position</span></button>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    @include('new_position')
                    @include('edit_position')
                    @if(session()->has('status'))
                    <div class="alert alert-success alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        {{session()->get('status')}}
                    </div>
                    @endif
                    <div class="ibox-content table-responsive">
                        <table class="table table-hover dataTables-example no-margins">
                            <thead>
                                <tr>
                                    <th>Job Title</th>
                                    <th width='400px;'>Job Description</th>
                                    <th>Job Requirements</th>
                                    <th>Job Level</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jobs as $job)
                                    <tr onclick="showeditposition('{{$job->id}}')">
                                        <td>{{$job->job_title}}</td>
                                        <td>{!! nl2br(e($job->job_description))!!}</td>
                                        <td>
                                            @if($job->qualifications != null)
                                                @foreach($job->qualifications as $key => $qualification)
                                                {{$key+1}}. {{$qualification->qualification}} <br>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>{{$job->job_level}}</td>
                                    {{-- <td><button class="btn btn-info" data-toggle="modal" data-target="#edit_position" onclick='showeditposition({{$job->id}})' data-toggle="edit_position" data-target="#new_position" type="button"><i class="fa fa-paste"></i> Edit</button></td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <script>
                function showeditposition(jobId)
                {
                    $("#edit_position").modal();
                    document.getElementById("myDiv").style.display="block";
                    $.ajax(
                        {  //create an ajax request to load_page.php
                            
                            type: "GET",
                            url: "{{ url('/job-description') }}",            
                            data:
                            {
                                "jobId" : jobId,
                            }     ,
                            dataType: "json",   //expect html to be returned
                            success: function(data)
                            {
                                
                                $('.edit-minimum-requirements').children().remove();
                                $('#edit_job_title').val(data.job_title);
                                $('#edit_job_id').val(jobId);
                                $('#edit_job_description').val(data.job_description);
                                $('#edit_job_level').val(data.job_level);
                                if(data.qualifications != null)
                                {
                                    jQuery.each(data.qualifications, function(idJob) {
                                    var idrequirements = $('.edit-minimum-requirements').children().last().attr('id');
                                    
                                    if(idrequirements == undefined)
                                    {
                                        var idrequirements =  1;
                                    }
                                    else
                                    {
                                        var res = idrequirements.split("-");
                                        var idrequirements = parseInt(res[1]) + 1;
                                    }
                                    var new_requirements = "<div class='row' id='edit-requirements-"+idrequirements+"'> <div  class='col-md-10 mb-1'><input class='form-control required' value='"+data.qualifications[idJob].qualification+"' placeholder='Minimum Requirements' type='text' name='requirement[]' required></div><div class='col-md-1'><button title='remove' onclick='removeeditPosition("+idrequirements+")' class='btn btn-outline btn-danger' type='button'><i class='fa fa-times-rectangle'></i></button></div></div>";
                                
                                    $(".edit-minimum-requirements").append(new_requirements);
                                    });
                                }
                                document.getElementById("myDiv").style.display="none";
                           
                            },
                            error: function(e)
                            {
                                
                                console.log(e);
                                document.getElementById("myDiv").style.display="none";
                            }
                        }
                        );
                }
            </script>
        </div>
    </div>
@endsection