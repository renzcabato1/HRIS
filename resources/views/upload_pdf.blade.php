
<div class="modal fade" id="upload_pdf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class='col-md-10'>
                    <h5 class="modal-title" id="exampleModalLabel">Upload PDF Billing</h5>
                </div>
                <div class='col-md-2'>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <form method='POST' action='upload-pdf-billing' onsubmit='show();'  enctype="multipart/form-data" >
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class='row'>
                        <div class='col-md-12'>
                           Month of :
                           <input type='month' class='form-control' name='period' required>
                              
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-12'>
                            Upload PDF/s :
                                <input name='upload_pdf[]' type="file" class="form-control" accept="application/pdf" multiple required>
                              
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
