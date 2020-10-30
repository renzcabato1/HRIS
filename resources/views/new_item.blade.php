
<div class="modal fade" id="new_item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            
                <div class="modal-header">
                    <div class='col-md-10'>
                        <h5 class="modal-title" id="exampleModalLabel">New Item</h5>
                    </div>
                    <div class='col-md-2'>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <form method='POST' action='new-type' onsubmit='show();' >
                
                <div class="modal-body">
                    
                    {{ csrf_field() }}
                    <div id='info' class='row'>
                        <div class='col-md-12'>
                            Company Line :
                            <input class='form-control' name='company' placeholder="" required >
                        </div>
                        <div class='col-md-12'>
                            Type :
                            <select class='form-control' name='type' required >
                                <option value=''></option>
                                @foreach($inventory_types as $type)
                                <option value='{{$type->name}}'>{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                      
                        <div class='col-md-12'>
                            Provider :
                            <input class='form-control' name='provider' placeholder="" required >
                        </div>
                        <div class='col-md-12'>
                            Account Number :
                            <input class='form-control required' type='number' name='account_number' placeholder="" required>
                        </div>
                        <div class='col-md-12'>
                            Service Number :
                            <input class='form-control required' type='number' name='service_number' placeholder="" required>
                        </div>
                        <div class='col-md-12'>
                            Plan Offer :
                            <input class='form-control required' name='plan_offer' placeholder="" required>
                        </div>
                        <div class='col-md-12'>
                            Plan Unit (Optional):
                            <input class='form-control required' name='plan_unit' placeholder="" >
                        </div>
                        <div class='col-md-12'>
                            Plan Description :
                            <textarea class='form-control required' name='plan_description' placeholder="" required></textarea>
                        </div>
                        <div class='col-md-12'>
                            Remarks (optional):
                            <textarea class='form-control' name='remarks' placeholder="" ></textarea>
                        </div>
                        <div class='col-md-12'>
                            Account Holder (optional):
                            <select  name='account_holder' class="chosen-select form-control"  onchange='account_change(this.value)'>
                                <option value=''>N/A</option>
                                @foreach($employees as $employee)
                                <option value='{{$employee->user_id}}'>{{$employee->first_name.' '.$employee->last_name}} - @if($employee->EmployeeCompany) {{$employee->EmployeeCompany[0]->company_abbreviation}} @endif</option>
                                @endforeach
                            </select>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type='submit' value='Submit' class="btn btn-primary" >Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function account_change(value)
    {
        if (value === '')
        {
            $(".info_inside").remove();
        }
        else
        {
            
        $(".info_inside").remove();
        var data = document.getElementById("info_inside");
        if(data === null) 
        {
            var info = "<div class='info_inside col-md-4'>";
                info += "Budget Code: <input class='form-control' type='text' name='budget_code' required>";
                info += "</div>";
                info += "<div class='info_inside col-md-4'>";
                info += "Date Assigned: <input class='form-control' type='date' name='date_assigned' value='{{date('Y-m-d')}}' required>";
                info += "</div>";
                info += "<div class='info_inside col-md-4'>";
                info += "Monthly Budget: <input class='form-control' type='number' step='0.01' name='monthly_budget'  required>";
                info += "</div>";
                $("#info").append(info); //add input box
            }
        }
    }
</script>