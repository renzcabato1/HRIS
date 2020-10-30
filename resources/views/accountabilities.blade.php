@extends('layouts.header')

@section('content')
@if(session()->has('status'))
<div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    {{session()->get('status')}}
</div>
@endif
@php
$roles = auth()->user()->role_info();
$roles = $roles->pluck('role_id')->toArray();
@endphp
<div class="wrapper wrapper-content animated fadeInRight">
    
    <div class="row">
        <div class="col-lg-12">
            <div class="panel blank-panel">
                <div class="panel-heading">
                    <div class="panel-options">
                        <ul class="nav nav-tabs">
                            <li><a class="nav-link active" href="#tab-1" data-toggle="tab" >Inventory </a></li>
                            <li><a class="nav-link" href="#tab-2" data-toggle="tab" >Accountabilities History</a></li>
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
                            <div class='row'>
                                <div class="col-lg-12">
                                    <div class="ibox ">
                                        <div class="ibox-content">
                                            <div class="table-responsive">
                                                <form method='POST' action='print-all'  target="_blank" >
                                                    {{ csrf_field() }}
                                                  
                                                    @if(in_array(2,$roles)) 
                                                      <button class="btn btn-primary" data-target="#new_item"  data-toggle="modal"type="button"><i class="fa fa-plus"></i>&nbsp;New Item</button>&nbsp;
                                                        <button type='submit' class="btn btn-success" ><i class="fa fa-print"></i>Print Selected</button>
                                                    @endif
                                                    <table  class="table table-striped table-bordered table-hover dataTables-example" id='example'>
                                                        <thead>
                                                           <tr>
                                                                <th >        @if(in_array(2,$roles)) <input type="checkbox" id='select' onclick="select_all()" class="selectall"/>Select all @endif</th>
                                                                <th >Company Line</th>
                                                                <th >Account Number</th>
                                                                <th >Type</th>
                                                                <th > Provider</th>
                                                                <th > Service Number</th>
                                                                <th > Status</th>
                                                                <th > Plan Offer</th>
                                                                <th > Plan Description</th>
                                                                <th > Phone Unit</th>
                                                                <th > Remarks</th>
                                                                <th > User ID</th>
                                                                <th > First name</th>
                                                                <th > Last name</th>
                                                                <th > Budget Code</th>
                                                                <th > Monthly Budget</th>
                                                                <th > Date Assigned</th>
                                                                <th > Company</th>
                                                                <th > Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($inventories as $key => $inventory)
                                                            <tr id='{{$key}}'>
                                                                <td > @if(in_array(2,$roles))  @if($inventory->status == 'Active') @if(count($inventory->accountabilities))<input type="checkbox" name="print_id[]" value='{{$inventory->id}}' required>@endif @endif @endif</td>
                                                                <td >{{$inventory->company_line}}</td>
                                                                <td >{{$inventory->account_number}}</td>
                                                                <td >{{$inventory->type}}</td>
                                                                <td >{{$inventory->provider}}</td>
                                                                <td >{{$inventory->service_number}}</td>
                                                                <td style='width:100px;' >{{$inventory->status}}</td>
                                                                <td >{{$inventory->plan_offer}}</td>
                                                                <td style='width:250px;' >{{$inventory->plan_description}}</td>
                                                                <td >{{$inventory->phone_unit}}</td>
                                                                <td >{{$inventory->remarks}}</td>
                                                                    @if(count($inventory->accountabilities))
                                                                    <td >{{$inventory->accountabilities[0]->user_info->user_id}}</td>
                                                                    <td >{{$inventory->accountabilities[0]->user_info->first_name}}</td>
                                                                    <td >{{$inventory->accountabilities[0]->user_info->last_name}}</td>
                                                                    <td >{{$inventory->accountabilities[0]->budget_code}}</td>
                                                                    <td > {{$inventory->accountabilities[0]->monthly_budget}}</td>
                                                                    <td >@if($inventory->accountabilities[0]->date_assigned){{ date('M. d, Y',strtotime($inventory->accountabilities[0]->date_assigned))}} @endif</td>
                                                                    <td >@if($inventory->accountabilities[0]->user_info->EmployeeCompany) {{$inventory->accountabilities[0]->user_info->EmployeeCompany[0]->name}} @endif</td>
                                                                    @else
                                                                    <td >
                                                                    </td>
                                                                    <td >
                                                                    </td>
                                                                    <td >
                                                                    </td>
                                                                    <td >
                                                                    </td>
                                                                    <td >
                                                                    </td>
                                                                    <td >
                                                                    </td>
                                                                    <td >
                                                                    </td>
                                                                    @endif
                                                                <td>
                                                                  
                                                                       @if(in_array(2,$roles)) 
                                                                            @if($inventory->status == 'Active')
                                                                                <a onclick='edit_item({{$key}})' data-target="#edit_item" data-toggle="modal" type="button"><i title='edit' class="fa fa-edit"></i></a><br>
                                                                                @if(count($inventory->accountabilities))
                                                                                <a href='{{ url('/print-contract/'.$inventory->id.'') }}' target="_blank"><i title='print' class="fa fa-print"></i></a><br>
                                                                                <a onclick='transfer_account({{$key}})' data-target="#transfer_of_account" data-toggle="modal" type="button"><i title='transfer account' class="fa fa-id-card"></i></a><br>
                                                                                <a onclick='remove_account({{$key}})' data-target="#remove_account" data-toggle="modal" type="button"><i title='remove account' class="fa fa-window-close"></i></a><br>
                                                                                <a onclick='deactivate_account({{$key}})' data-target="#deactivate_account" data-toggle="modal" ><i title='Deactivate Account' class="fa fa-close"></i></a><br>
                                                                                
                                                                                @else
                                                                                <a onclick='assign_account({{$key}})' data-target="#assign_account" data-toggle="modal" type="button"><i title='Assign Account' class="fa fa-id-card"></i></a><br>
                                                                                <a onclick='deactivate_account({{$key}})' data-target="#deactivate_account" data-toggle="modal" ><i title='Deactivate Account' class="fa fa-close"></i></a><br>
                                                                                
                                                                                @endif
                                                                            
                                                                            @endif
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                       
                                                    </table>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-2">
                            <div class='row'>
                                <div class="col-lg-12">
                                    <div class="ibox ">
                                        <div class="ibox-content">
                                            <div class="table-responsive">
                                                <table width='100%'  class="table table-striped table-bordered table-hover dataTables-example" >
                                                    <thead>
                                                        <tr>
                                                            <th > Type</th>
                                                            <th > Provider</th>
                                                            <th > Service Number</th>
                                                            <th > Status</th>
                                                            <th > Plan Offer</th>
                                                            <th > Plan Description</th>
                                                            <th > Phone Unit</th>
                                                            <th > Remarks</th>
                                                            <th > User</th>
                                                            <th > Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
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
        </div>
    </div>
</div>
<div class="footer">
</div>
@include('new_item')
@include('edit_item')
@include('transfer_of_account')
@include('assign_account')
@include('remove_account')
@include('deactivate_account')
<script>
    function select_all()
    {
        var checkBox = document.getElementById("select");
        if(checkBox.checked == true) 
        {
            // alert('renz');
            // Iterate each checkbox
            $(':checkbox').each(function() {
                this.checked = true;                        
            });
        }
        else
        {
            // alert('renz1');
            $(':checkbox').each(function() {
                this.checked = false;                       
            });
        }
    }
</script>
@endsection
