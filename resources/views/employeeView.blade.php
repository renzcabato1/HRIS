@extends('layouts.header')

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel blank-panel">
                <div class="panel-heading">
                    <div class="panel-options">
                        <ul class="nav nav-tabs">
                            <li><a class="nav-link active" href="#tab-1" data-toggle="tab" onclick='viewActiveEmployee()'>Active ({{$activeCount}})</a></li>
                            <li><a class="nav-link" href="#tab-2" data-toggle="tab"  onclick='viewInactiveEmployee()'>Inactive ({{$inactiveCount}})</a></li>
                            <li><a class="nav-link" href="#tab-3" data-toggle="tab" onclick='viewProbationaryActive()'>Probationary Active ({{$provitionaryCount}})</a></li>
                            <li><a class="nav-link" href="#tab-4" data-toggle="tab" onclick='viewRegularActive()'>Regular Active ({{$regularCount}})</a></li>
                            <li><a class="nav-link" href="#tab-5" data-toggle="tab" onclick='viewProjectActive()'>Project Based Active ({{$projectCount}})</a></li>
                            <li><a class="nav-link" href="#tab-6" data-toggle="tab" onclick='viewConsultantActive()'>Consultant Active ({{$consultantCount}})</a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="ibox-content" id='Loading' style="display:none;">
                        <div class="spiner-example">
                            <div class="sk-spinner sk-spinner-three-bounce">
                                <div class="sk-bounce1"></div>
                                <div class="sk-bounce2"></div>
                                <div class="sk-bounce3"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-1">
                            <div class='row' id='tab-1-data'>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-2">
                            <div class='row' id='tab-2-data'>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-3">
                            <div class='row' id='tab-3-data'>
                                
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-4">
                            <div class='row' id='tab-4-data'>
                                
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-5">
                            <div class='row' id='tab-5-data'>
                                
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-6">
                            <div class='row' id='tab-6-data'>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
