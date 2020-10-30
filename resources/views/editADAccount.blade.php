<div class="modal fade" id="edit_account" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class='col-md-10'>
                    <h5 class="modal-title" id="exampleModalLabel">Edit Account</h5>
                </div>
                <div class='col-md-2'>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <form  method='POST' action='save-edit-account/' onsubmit='show();'  >
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class='row'>
                        <div class='col-md-6'>
                            First Name :
                            <input class='form-control' name='first_name' id='edit_first_name'  type='text' required>
                        </div>
                        <div class='col-md-6'>
                            Surname :
                            <input class='form-control' name='surname' id='edit_surname' type='text' required>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-12'>
                            Email :
                            <input class='form-control' name='email'  id='edit_email' type='email' required>
                        </div>
                    </div>
                    <div class='row company'>
                       
                    </div>
                    <div class='row'>
                        <div class='col-md-6 department'>
                            Department :
                            
                                <option ></option>
                                @foreach($departments as $department)
                                <option value='{{$department->name}}'>{{$department->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class='col-md-6 site'>
                            Site :
                            <select class='form-control chosen-select' data-placeholder="Choose a Site..." placeholder='Select Site' name="location" edit_location  required>
                                <option ></option>
                                @foreach($sites as $site)
                                <option value='{{$site->name}}'>{{$site->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-12'>
                            Job Title :
                            <input class='form-control' name='job_title'  id='edit_title'>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-12'>
                            Job Description :
                            <textarea name='jobDescription' class='form-control' id='edit_description'></textarea>
                        </div>
                    </div>
                    <div class='row ou'>
                        <div class='col-md-4'>
                            Main Ou :
                            <select id='mainOu' class='form-control chosen-select' data-placeholder="Choose a main Ou..." onchange="oumain(this.value)"  name="ou[]"  required>
                                <option ></option>
                                @foreach($infos_ou as $info_ou)
                                <option value='{{$info_ou['ou'][0]}}'>{{$info_ou['ou'][0]}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-12'>
                            Direct Reporting to :
                            <select  class='form-control chosen-select' data-placeholder="Choose a Manager"  name="manager"  required>
                                <option ></option>
                                @foreach($infos as $info)
                                @for ($i = 0; $i <=  $info['count'] -1 ; $i++)
                                @if(array_key_exists('useraccountcontrol', $info[$i]))
                                @php
                                $accountStatus = $info[$i]["useraccountcontrol"][0];
                                $disable=($accountStatus | 2); // set all bits plus bit 1 (=dec2)
                                $enable =($accountStatus & ~2);
                                @endphp
                                @if($accountStatus != $disable)
                                <option value='{{$info[$i]['dn']}}' >  @if(array_key_exists('cn', $info[$i])){{($info[$i]['cn'][0])}} @endif</option>
                                @endif
                                @endif
                                @endfor
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id='' class="btn btn-primary" >Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

