@extends('layouts.header')

@section('content')
@if(session()->has('status'))
<div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    {{session()->get('status')}}
</div>
@endif
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-content">
                    <div class="table-responsive">
                        @include('new_account')    
                        <button class="btn btn-primary" data-target="#upload_billing" data-toggle="modal" type="button"><i class="fa fa-upload"></i>&nbsp;New Account</button>
                            
                        <table  class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th > Name </th>
                                    <th > Email</th>
                                    <th > Company</th>
                                    <th > Department</th>
                                    <th > Location  </th>
                                    <th > Role  </th>
                                    <th > Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($accounts as $account)
                                <tr>
                                    <td>{{$account->user_info->first_name." ".$account->user_info->last_name}}
                                    </td>
                                    <td>{{$account->user_info->EmployeeUser->email}}
                                    </td>
                                    <td>
                                        {{$account->user_info->EmployeeCompany[0]->name}}
                                    </td>
                                    <td>
                                        {{$account->user_info->EmployeeDepartment[0]->name}}
                                    </td>
                                    <td>
                                        {{$account->user_info->EmployeeLocation[0]->name}}
                                    </td>
                                    <td>
                                        @foreach($account->role_info as $role)
                                            {{$role->role_data->role}}<br>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a onclick='' data-target="#edit" data-toggle="modal" type="button"><i title='edit' class="fa fa-edit"></i></a><br>
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
<div class="footer">

</div>
<script type='text/javascript'>

</script>
@endsection
