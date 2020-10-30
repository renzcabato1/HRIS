<div class="modal fade" id="reject_applicant{{$applicant->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class='col-md-10'>
                    <h5 class="modal-title" id="exampleModalLabel">Reject Interview</h5>
                </div>
                <div class='col-md-2'>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <form  method="POST"  action='reject-applicant/{{$applicant->id}}' onsubmit='show();'  >
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <div class='row'>
                            <div class='col-lg-12'>
                                Remarks
                                <textarea  class='form-control'  name='remarks'></textarea>
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