
<div class="modal fade" id="new_exam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class='col-md-10'>
                    <h5 class="modal-title" id="exampleModalLabel">New Exam</h5>
                </div>
                <div class='col-md-2'>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <form method='POST' action='new-exam' onsubmit='show();'  enctype="multipart/form-data" >
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class='row'>
                        <div class='col-md-12'>
                            Question :
                            <textarea name='question' class='form-control'></textarea>
                        </div>
                    </div>
                    <div class='col-md-12'>
                        Choices :
                    </div>
                    <div class="input-group m-b">
                        <div class="input-group-prepend">
                            <span class="input-group-addon">
                            <input name='answer' value='1' type="radio" required>
                                </span>
                        </div>
                        <input type="text" class="form-control">
                        <div class="input-group-prepend">
                            <span class="input-group-addon">
                                <input name='attachments[]' value='1' type="file" accept="image/x-png,image/gif,image/jpeg" >
                            </span>
                        </div>
                    </div>
                    <div class="input-group m-b">
                        <div class="input-group-prepend">
                            <span class="input-group-addon">
                            <input type="radio" name='answer' value='2' required>
                                </span>
                        </div>
                        <input type="text" class="form-control">
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
