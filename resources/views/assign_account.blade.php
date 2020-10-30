
<div class="modal fade" id="assign_account" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class='col-md-10'>
                    <h5 class="modal-title" id="exampleModalLabel">Assign Account</h5>
                </div>
                <div class='col-md-2'>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <form method='POST' action='assign-account' onsubmit='show();'  >
                <div class="modal-body">
                    {{ csrf_field() }}
                    
                    <input class='form-control' name='id' id='id_assign' type='hidden' required>
                    <div class='row'>
                        <div class='col-md-12'>
                            Assign To :
                            <select  name='transfer_to' class="chosen-select form-control"  required>
                                <option value=''></option>
                                @foreach($employees as $employee)
                                    <option value='{{$employee->user_id}}'>{{$employee->first_name.' '.$employee->last_name}} - @if($employee->EmployeeCompany) {{$employee->EmployeeCompany[0]->company_abbreviation}} @endif</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-12'>
                            Date Assign :
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
    function assign_account(id)
    {
        var transfer_account = {!! json_encode($inventories->toArray()) !!};
        document.getElementById("id_assign").value = transfer_account[id].id;

    }
</script>
