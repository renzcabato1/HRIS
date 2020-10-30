<div class="modal fade" id="view_manpower" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class='col-md-10'>
                    <h5 class="modal-title" id="exampleModalLabel">View Manpower</h5>
                </div>
                <div class='col-md-2'>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                {{ csrf_field() }}
                <div class="form-group">
                    <div class='row'>
                        <div class='col-lg-8'>
                            <label class="font-normal">Company : </label> 
                            <input class='form-control' type='hidden' id='view_manpower' >
                            <span id='company_view'></span>
                        </div>
                        <div class='col-lg-4'>
                            <label class="font-normal">Site :</label>
                            <span id='site_view'></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class='row'>
                        <div class='col-lg-8'>
                            <label class="font-normal">Department :</label> 
                            <input class='form-control' type='hidden' id='view_manpower' >
                            <span id='department_view'></span>
                        </div>
                        <div class='col-lg-4'>
                            <label class="font-normal"> No. of Personnel Needed:</label>
                            <span id='personnel_needed'></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class='row'>
                        <div class='col-lg-8'>
                            <label class="font-normal">Directly Reporting to :</label>
                            <span id='reporting_to'></span>
                        </div>
                        <div class='col-lg-4'>
                            <label class="font-normal">Cost Center:</label>
                            <span id='cost_center'></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class='row'>
                        <div class='col-lg-12'>
                            <label class="font-normal">Job Title :</label>
                            <span id='job_title'></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class='row'>
                        <div class='col-lg-12'>
                            <label class="font-normal">Job Description :</label><br>
                            <div id='job_description'></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class='row'>
                        <div class='col-lg-12'>
                            <label class="font-normal">Job Requirements :</label><br>
                            <div class='job_requirements'></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class='row'>
                        <div class='col-lg-4'>
                            <label class="font-normal">Type of Hiring :</label>
                            <span id='type_of_hiring'></span><br>
                        </div>
                        <div class='col-lg-4 type_of_requisition'>
                            <label class="font-normal">Type of Requisition :</label>
                            <span id='type_of_requisition'></span><br>
                            
                        </div>
                        <div class='col-lg-4 status_of_employment'>
                            <label class="font-normal">Status of Employment :</label>
                            <span id='status_of_employment'></span><br>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <div class="pt-3 row table-approver">
                     
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                {{-- <a><button type="submit" onclick='show()'  class="btn btn-primary" >Cancel</button></a> --}}
            </div>
        </div>
    </div>
</div>
