
<div class="modal fade" id="upload_billing" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class='col-md-10'>
                    <h5 class="modal-title" id="exampleModalLabel">New Account</h5>
                </div>
                <div class='col-md-2'>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <form method='POST' action='new-account' onsubmit='show();'  enctype="multipart/form-data" >
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class='col-md-12'>
                       Account (optional):
                        <select  name='user[]' class="chosen-select form-control"  multiple>
                            {{-- <option value=''>N/A</option> --}}
                            @foreach($employees as $employee)
                            <option value='{{$employee->user_id}}'>{{$employee->first_name.' '.$employee->last_name}} - @if($employee->EmployeeCompany) {{$employee->EmployeeCompany[0]->company_abbreviation}} @endif</option>
                            @endforeach
                        </select>
                    </div>
                    <div class='col-md-12'>
                     Roles:
                        <select  name='roles[]' class="chosen-select form-control"  multiple>
                            {{-- <option value=''>N/A</option> --}}
                            @foreach($roles as $role)
                            <option value='{{$role->id}}'>{{$role->role}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type='submit'  class="btn btn-primary" >Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>