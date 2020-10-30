
<div class="modal fade" id="transfer_of_account" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class='col-md-10'>
                    <h5 class="modal-title" id="exampleModalLabel">Transfer Account</h5>
                </div>
                <div class='col-md-2'>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <form method='POST' action='transfer-account' onsubmit='show();'  >
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class='row'>
                        <div class='col-md-12'>
                            Previous Account Holder
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-4'>
                                Name : <span id='name_previous_account'></span> 
                        </div>
                        <div class='col-md-4'>
                                Budget Code : <span id='previous_budget_code'></span>
                        </div>
                        <div class='col-md-4'>
                                Montly Budget : <span id='previous_monthly_budget'></span> 
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-12'>
                            <input class='form-control' name='id' id='id_transfer' type='hidden' required>
                            Turn Over Date :
                            <input class='form-control' name='date_expired' max='{{date('Y-m-d')}}' value='{{date('Y-m-d')}}' type='date' required>
                        </div>
                    </div>
                    <hr>
                    <div class='row'>
                        <div class='col-md-12'>
                            Transfer To :
                            <select  name='transfer_to' class="chosen-select form-control" required >
                                <option value=''></option>
                                @foreach($employees as $employee)
                                    <option value='{{$employee->user_id}}'>{{$employee->first_name.' '.$employee->last_name}} - @if($employee->EmployeeCompany) {{$employee->EmployeeCompany[0]->company_abbreviation}} @endif</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-12'>
                            Date Transfer :
                            <input class='form-control' name='date_transfer'  type='date' value='{{date('Y-m-d')}}' required>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-12'>
                            Budget Code :
                            <input class='form-control' name='budget_code' required>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-12'>
                            Monthly Budget :
                            <input class='form-control' name='monthly_budget'  type='number' step='0.01' required>
                        </div>
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
<script>
    function transfer_account(id)
    {
        var transfer_account = {!! json_encode($inventories->toArray()) !!};
        document.getElementById("id_transfer").value = transfer_account[id].id;
        document.getElementById("name_previous_account").innerHTML  = transfer_account[id].accountabilities[0].user_info.first_name+' '+transfer_account[id].accountabilities[0].user_info.last_name;
        document.getElementById("previous_budget_code").innerHTML  = transfer_account[id].accountabilities[0].budget_code;
        document.getElementById("previous_monthly_budget").innerHTML  = transfer_account[id].accountabilities[0].monthly_budget;

    }
</script>
