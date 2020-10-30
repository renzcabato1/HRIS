
<div class="modal fade" id="forapproval{{$for_App->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            
                <div class="modal-header">
                    <div class='col-md-10'>
                        <h5 class="modal-title" id="exampleModalLabel">Verify Manpower</h5>
                    </div>
                    <div class='col-md-2'>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <form method='POST' action='verify-manpower/{{$for_App->id}}' onsubmit='show();' >
                <div class="modal-body">
                    {{ csrf_field() }}
                    @if($for_App->type == 'Finance Manager')
                        <div class='col-md-12'>
                            Budget : 
                            <select name='budget' class='form-control' required>
                                <option value=''></option>
                                <option value='with budget'>with budget</option>
                                <option value='without budget'>without budget</option>
                            </select>
                        </div>
                    @endif
                    <div class='col-md-12'>
                        Remarks :
                        <textarea class='form-control' name='remarks' placeholder="" required ></textarea>
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
