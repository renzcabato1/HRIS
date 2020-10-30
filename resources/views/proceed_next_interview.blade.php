<div class="modal fade" id="proceed_interivew{{$applicant->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class='col-md-10'>
                    <h5 class="modal-title" id="exampleModalLabel">Proceed to next Interview</h5>
                </div>
                <div class='col-md-2'>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <form   method="POST" action='proceed-next/{{$applicant->id}}' onsubmit='show();'  enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <div class='row'>
                            <div class='col-lg-6'>
                                Scheduled Interview
                                <input class='form-control'  name='date_scheduled' type='date' min={{date('Y-m-d',strtotime("+1 days"))}} required>
                            </div>
                            <div class='col-lg-4'>
                                Scheduled Time
                                <input type="time" class="form-control" name='time_scheduled' value="08:30" required >
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-lg-12'>
                                Position
                            <input class='form-control' value='{{$applicant->position}}'  name='position' type='text' required>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-lg-12'>
                                Interviewer
                                <select  name='interviewer[]' class="chosen-select form-control" placeholder="Please choose interviewer" multiple required>
                                    <option value=''></option>
                                    @foreach($employees as $employee)
                                        <option value='{{$employee->user_id}}'>{{$employee->first_name.' '.$employee->last_name}} - @if($employee->EmployeeCompany) {{$employee->EmployeeCompany[0]->company_abbreviation}} @endif</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class='row'>
                            <div class='col-lg-12'>
                                Remarks
                                <textarea  class='form-control'  name='remarks'>{{$applicant->remarks}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class='row'>
                            <div class='col-lg-12'>
                                <div class="custom-file">
                                    <input id="logo" type="file" name='file' class="custom-file-input" required>
                                    <label for="logo" class="custom-file-label" >Choose file...</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a><button type="submit" class="btn btn-primary" >Submit</button></a>
                </div>
            </form>
        </div>
    </div>
</div>