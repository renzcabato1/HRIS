
<div class="modal fade" id="edit_item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class='col-md-10'>
                    <h5 class="modal-title" id="exampleModalLabel">Edit Item</h5>
                </div>
                <div class='col-md-2'>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <form method='POST' action='edit-type' onsubmit='show();'  >
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class='row'>
                        <input id='id' class='form-control' type='hidden' name='id' placeholder="" required >
                        <div class='col-md-12'>
                            Type :
                            <select id='type' class='form-control' name='type' required >
                                <option value=''></option>
                                    @foreach($inventory_types as $type)
                                    <option value='{{$type->name}}'>{{$type->name}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class='col-md-12'>
                            Provider :
                            <input id='provider' class='form-control' name='provider' placeholder="" required >
                        </div>
                        <div class='col-md-12'>
                            Service Number :
                            <input id='service_number' class='form-control required' name='service_number' placeholder="" required>
                        </div>
                        <div class='col-md-12'>
                            Plan Offer :
                            <input id='plan_offer' class='form-control required' name='plan_offer' placeholder="" required>
                        </div>
                        <div class='col-md-12'>
                            Plan Unit (Optional):
                            <input id='plan_unit'  class='form-control required' name='plan_unit' placeholder="" >
                        </div>
                        <div class='col-md-12'>
                            Plan Description :
                            <textarea  id='plan_description' class='form-control required' name='plan_description' placeholder="" required></textarea>
                        </div>
                        <div class='col-md-12'>
                            Remarks (optional):
                            <textarea id='remarks' class='form-control' name='remarks' placeholder="" ></textarea>
                        </div>
                        <div class='col-md-12'>
                            Account Holder :
                            <input class='form-control' id='account_holder' value='' readonly>
                        </div>
                        <div class='info col-md-12'>
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
    function edit_item(id)
    {
        var accountabilites = {!! json_encode($inventories->toArray()) !!};
        // console.log(accountabilites[id]);
        document.getElementById("id").value = accountabilites[id].id;
        document.getElementById("type").value = accountabilites[id].type;
        document.getElementById("provider").value = accountabilites[id].provider;
        document.getElementById("service_number").value = accountabilites[id].service_number;
        document.getElementById("plan_offer").value = accountabilites[id].plan_offer;
        document.getElementById("plan_unit").value = accountabilites[id].phone_unit;
        document.getElementById("plan_description").value = accountabilites[id].plan_description;
        document.getElementById("remarks").value = accountabilites[id].remarks;
        document.getElementById("account_holder").value = accountabilites[id].accountabilities[0].user_info.first_name+' '+accountabilites[id].accountabilities[0].user_info.last_name;
    }
</script>