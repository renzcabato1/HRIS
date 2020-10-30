@extends('layouts.header')

@section('content')
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    {{-- <span class="label label-success float-right">Monthly</span> --}}
                    <h5>Active Employee</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{count($employee_active)}}</h1>
                    <div class="stat-percent font-bold text-info"> {{count($employees)}} </div>
                    <small>New employee for {{date('M. d, Y',strtotime($employee_date_hired->date_hired))}}</small>
                </div>
            </div>
        </div>
        
        {{-- <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <span class="label label-primary float-right">As of Today</span>
                    <h5>Open Position</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{$approved_manpower_requests}}</h1>
                    <div class="stat-percent font-bold text-navy">{{$manpowerapplicants}}</i></div>
                    <small>Applicants</small>
                </div>
            </div>
        </div> --}}
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <span class="label label-primary float-right">As of Today</span>
                    <h5>For Interview</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">0</h1>
                    <div class="stat-percent font-bold text-navy">0</i></div>
                    <small>Tomorrow</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <span class="label label-warning float-right">As of Today</span>
                    <h5>Pending Manpower Request</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{$manpowers}}</h1>
                    <div class="stat-percent font-bold text-danger"></div>
                    <small>{{date("F Y")}}</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <span class="label label-primary float-right">As of Today</span>
                    <h5>Approved Manpower Request</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{$approved_manpower_requests}}</h1>
                    <div class="stat-percent font-bold text-danger"></div>
                    <small>{{date("F Y")}}</small>
                </div>
            </div>
        </div>
    </div>
    
    
{{--     
    <div class="row">
        <div class="col-lg-4">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Announcements</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="feed-activity-list">
                        
                        <div class="feed-element">
                            <div>
                                <small class="float-right text-navy">1m ago</small>
                                <strong>Monica Smith</strong>
                                <div>Sample Announcement</div>
                                <small class="text-muted">Today 5:60 pm - 12.06.2014</small>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
                
            </div>
            
        </div>
        
        <div class="col-lg-8">
            
            <div class="row">
                
                <div class="col-lg-6">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Manpower Request</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-hover ">
                                        <thead>
                                            <tr>
                                                <th style="width: 1%" class="text-center">No.</th>
                                                <th>Name</th>
                                                <th class="text-center">Quantity</th>
                                                <th class="text-center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td> Renz Christian Cabato</td>
                                                <td class="text-center small">3</td>
                                                <td class="text-center"><span class="label label-success">For Approval</span></td>
                                                
                                            </tr>
                                            <tr>
                                                <td class="text-center">2</td>
                                                <td> Demetrio Viray
                                                </td>
                                                <td class="text-center small">2</td>
                                                <td class="text-center"><span class="label label-primary">Approved</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
        </div>
        
        
    </div> --}}
    <div class='row'>
        <div class="col-lg-6">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Birthday Celebrants</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content table-responsive">
                    <table class="table table-hover dataTables-example no-margins">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Company</th>
                                <th>Location</th>
                                <th>Birth Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($birth_date_celebrants as $birth_date_celebrant)
                                <tr>
                                    <td><small><img class="rounded-circle" style='width:34px;height:34px;' src='http://10.96.4.40:8441/hrportal/public/id_image/employee_image/{{$birth_date_celebrant->id}}.png' onerror="this.src='{{URL::asset('/images/no_image.png')}}';"></small></td>
                                    <td><small>{{$birth_date_celebrant->first_name.' '.$birth_date_celebrant->last_name}}</small></td>
                                    <td><small>@if (!$birth_date_celebrant['EmployeeCompany']->isEmpty()) {{$birth_date_celebrant['EmployeeCompany'][0]->name}}  @endif</small></td>
                                    <td><small>@if (!$birth_date_celebrant['EmployeeLocation']->isEmpty()) {{$birth_date_celebrant['EmployeeLocation'][0]->name}}  @endif</small></td>
                                    <td><small>{{date('M. d, Y',strtotime($birth_date_celebrant->birthdate))}}</small></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>New Employee for {{date('M. d, Y',strtotime($employee_date_hired->date_hired))}}</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content table-responsive">
                    <table class="table table-hover no-margins dataTables-example ">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Company</th>
                                <th>Location</th>
                                <th>Position</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                            <tr>
                                <td><small><img class="rounded-circle" style='width:34px;height:34px;' src='http://10.96.4.40:8441/hrportal/public/id_image/employee_image/{{$employee->id}}.png' onerror="this.src='{{URL::asset('/images/no_image.png')}}';"></small></td>
                                <td><small>{{$employee->first_name.' '.$employee->last_name}}</small></td>
                                <td><small>@if (!$employee['EmployeeCompany']->isEmpty()) {{$employee['EmployeeCompany'][0]->name}}  @endif</small></td>
                                <td><small>@if (!$employee['EmployeeLocation']->isEmpty()) {{$employee['EmployeeLocation'][0]->name}}  @endif</small></td>
                                <td >{{$employee->position}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</div>

<div class="footer">
    
</div>

</div>



@endsection
