<div class="modal fade" id="new_position" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class='col-md-10'>
                    <h5 class="modal-title" id="exampleModalLabel">New Position</h5>
                </div>
                <div class='col-md-2'>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <form  method='POST' action='new-position' onsubmit='show();'  >
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class='row'>
                        <div class='col-md-12'>
                            Job Title :
                            <input class='form-control' type='text' name='job_title' required>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-12'>
                            Job Description :
                            <textarea style='min-height:250px;' name='jobDescription' class='form-control' required></textarea>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-12'>
                            Job Level :
                            <select class='form-control' data-placeholder="Choose level..." name="job_level"  >
                                <option value=''></option>
                                @foreach($job_levels as $job_level)
                                <option value='{{$job_level->level}}'>{{$job_level->level}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-12'>
                            Minimum Requirements :
                        </div>
                        <div class='minimum-requirements col-md-12'>
                           
                        </div>
                        <div class='col-md-12'>
                            <button class="btn btn-primary" onclick='addMinimumRequirements()' type="button"><i class="fa fa-plus-square-o"></i>&nbsp;Add Requirements</button>
                            
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id='' class="btn btn-primary" >Submit</button>
                </div>
            </form>
        </div>
        <script>
            function addMinimumRequirements()
            {
                var idrequirements = $('.minimum-requirements').children().last().attr('id');
                
                if(idrequirements == undefined)
                {
                    var idrequirements =  1;
                }
                else
                {
                    var res = idrequirements.split("-");
                    var idrequirements = parseInt(res[1]) + 1;
                }
                var new_requirements = "<div class='row' id='requirements-"+idrequirements+"'> <div  class='col-md-10 mb-1'><input class='form-control required' placeholder='Minimum Requirements' type='text' name='requirement[]' required></div><div class='col-md-1'><button title='remove' onclick='removePosition("+idrequirements+")' class='btn btn-outline btn-danger' type='button'><i class='fa fa-times-rectangle'></i></button></div></div>";
            
                $(".minimum-requirements").append(new_requirements);  
            }
            function removePosition(requirementID)
            {
                $("#requirements-"+requirementID).remove();
            }
        </script>
    </div>
</div>
