<div class="modal fade" id="new_account" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class='col-md-10'>
                    <h5 class="modal-title" id="exampleModalLabel">New Account</h5>
                </div>
                <div class='col-md-2'>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <form  method='POST' action='add-ADAccount' onsubmit='show();'  >
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class='row'>
                        <div class='col-md-6'>
                            First Name :
                            <input class='form-control' name='first_name' type='text' required>
                        </div>
                        <div class='col-md-6'>
                            Surname :
                            <input class='form-control' name='surname' type='text' required>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-12'>
                            Email :
                            <input class='form-control' name='email'  type='email' requireds>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-12'>
                            Company :
                            <select class='form-control chosen-select' data-placeholder="Choose a Company..." name="company"  required>
                                <option ></option>
                                @foreach($companies as $company)
                                <option value='{{$company->name}}'>{{$company->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-6'>
                            Department :
                            <select class='form-control chosen-select' data-placeholder="Choose a Department..."  name="department"  required>
                                <option ></option>
                                @foreach($departments as $department)
                                <option value='{{$department->name}}'>{{$department->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class='col-md-6'>
                            Site :
                            <select class='form-control chosen-select' data-placeholder="Choose a Site..." placeholder='Select Site' name="location"  required>
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
                            <input class='form-control' name='job_title' >
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-12'>
                            Job Description :
                            <textarea name='jobDescription' class='form-control'></textarea>
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
<script>
    function oumain(value)
    {
        $("#onsub1").remove();
        $("#onsub2").remove();
        document.getElementById("myDiv").style.display="block";
        $.ajax(
        {    //create an ajax request to load_page.php
            
            type: "GET",
            url: "{{ url('/get-ou-sub') }}",            
            data:
            {
                "value" : value,
            }     ,
            dataType: "json",   //expect html to be returned
            success: function(data)
            { 
                if(data.count > 0)
                {
                    var subOu = "<div id='onsub1' class=' col-md-4'> Sub Ou :<select class='form-control chosen-select' data-placeholder='Choose a sub Ou...' onchange='ousub1(this.value)'  name='ou[]' required>";
                        subOu += "<option></option>";
                        for (var i = 0; i <=  data.count-1 ; i++)
                        {
                            subOu += "<option>"+data[i].ou[0]+"</option>";
                        }
                        subOu += "</select></div>";
                        $('<link/>', {rel: 'stylesheet',type: 'text/css',href: '{{ asset('bootstrap/css/plugins/chosen/bootstrap-chosen.css') }}'}).appendTo('head');
                        var chosen_js = '{{ asset('bootstrap/js/plugins/chosen/chosen.jquery.js') }}';        
                        $.getScript(chosen_js,function(jd) {$('.chosen-select').chosen({width: "100%"}); });     
                        $(".ou").append(subOu);  
                    }
                    document.getElementById("myDiv").style.display="none";
                },
                error: function(e)
                {
                    
                    console.log(e);
                    document.getElementById("myDiv").style.display="none";
                }
            }
            );
        }
        function  ousub1(subou)
        {
            var mainOu = document.getElementById("mainOu").value;
            $("#onsub2").remove();
            document.getElementById("myDiv").style.display="block";
            $.ajax(
            {    //create an ajax request to load_page.php
                
                type: "GET",
                url: "{{ url('/get-ou-sub-sub') }}",            
                data:
                {
                    "subou" : subou,
                    "mainOu" : mainOu,
                }     ,
                dataType: "json",   //expect html to be returned
                success: function(data)
                {
                    if(data.count > 0)
                    {
                        var subOu = "<div id='onsub2' class=' col-md-4'> Sub Ou :<select class='form-control chosen-select' data-placeholder='Choose a sub Ou...'   name='ou[]' required>";
                            subOu += "<option></option>";
                            
                            for (var i = 0; i <=  data.count-1 ; i++)
                            {
                                subOu += "<option>"+data[i].ou[0]+"</option>";
                            }
                            subOu += "</select></div>";
                            $('<link/>', {rel: 'stylesheet',type: 'text/css',href: '{{ asset('bootstrap/css/plugins/chosen/bootstrap-chosen.css') }}'}).appendTo('head');
                            var chosen_js = '{{ asset('bootstrap/js/plugins/chosen/chosen.jquery.js') }}';        
                            $.getScript(chosen_js,function(jd) {$('.chosen-select').chosen({width: "100%"}); });     
                            $(".ou").append(subOu);  
                        }
                        document.getElementById("myDiv").style.display="none";
                    },
                    error: function(e)
                    {
                        
                        console.log(e);
                        document.getElementById("myDiv").style.display="none";
                    }
                }
                );
                
            }
        </script>
        