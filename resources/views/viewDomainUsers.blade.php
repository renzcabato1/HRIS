@extends('layouts.header')

@section('content')
<div class="wrapper wrapper-content">
    <div class='row'>
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Active Directory</h5>   <button class="btn btn-success " data-toggle="modal" data-target="#new_account" data-toggle="new_account" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold">New Account</span></button>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                @include('newADaccount')
                {{-- @include('editADAccount') --}}
                <div class="ibox-content table-responsive">
                    <table class="table table-hover dataTables-example no-margins">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>First Name</th>
                                <th>Surname</th>
                                <th>Account Name</th>
                                <th>Principal Name</th>
                                <th>Date Created</th>
                                <th>Last Log In</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($infos as $info) 
                            @if($info['count'] > 1)
                            @for ($i = 0; $i <=  $info['count'] -1 ; $i++)
                            {{-- {{dd($info[0])}} --}}
                            
                            {{-- <tr onclick="showDetails('{{$info[$i]['samaccountname'][0]}}')"> --}}
                            <tr>
                                <td>
                                    @if(array_key_exists('mail', $info[$i]))
                                    {{$info[$i]['mail'][0]}}
                                    @endif
                                </td>
                                <td>
                                    @if(array_key_exists('givenname', $info[$i]))
                                    {{($info[$i]['givenname'][0])}}
                                    @endif
                                </td>
                                <td>
                                    @if(array_key_exists('sn', $info[$i]))
                                    {{($info[$i]['sn'][0])}}
                                    @endif
                                </td>
                                
                                <td>
                                    {{($info[$i]['samaccountname'][0])}}
                                    
                                </td>
                                
                                <td>
                                    @if(array_key_exists('userprincipalname', $info[$i]))
                                    {{($info[$i]['userprincipalname'][0])}}
                                    @endif
                                </td>
                                <td>
                                    @php
                                    $string1 = preg_replace ('/^(\d{4})(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})(.*)/', '$1-$2-$3 $4:$5:$6', $info[$i]['whencreated'][0]);
                                    @endphp
                                    {{date('M d, Y h:i a',strtotime($string1))}}
                                </td>
                                <td>
                                    @if(array_key_exists('lastlogontimestamp', $info[$i]))
                                    {{date('M d, Y h:i a',$info[$i]['lastlogontimestamp'][0]/10000000-11644473600)}}
                                    @endif
                                </td>
                                <td>
                                    @if(array_key_exists('useraccountcontrol', $info[$i]))
                                    @php
                                    $accountStatus = $info[$i]["useraccountcontrol"][0];
                                    $disable=($accountStatus | 2); // set all bits plus bit 1 (=dec2)
                                    $enable =($accountStatus & ~2);
                                    @endphp
                                    
                                    @if($accountStatus == $disable)
                                    Disable
                                    @else
                                    Enable 
                                    @endif
                                    @endif<br>
                                    
                                </td>
                                <td>
                                    @if(array_key_exists('useraccountcontrol', $info[$i]))
                                    @if($accountStatus == $disable)
                                    <a href='{{ url('/enable-ad/'.$info[$i]["samaccountname"][0].'') }}' onclick='show()'><button title='Enable' class="btn btn-outline btn-primary dim" type="button"><i class="fa fa-check"></i></button></a>
                                    @else
                                    <a href='{{ url('/disable-ad/'.$info[$i]["samaccountname"][0].'') }}' onclick='show()'><button title='Disable' class="btn btn-outline btn-warning dim" type="button"><i class="fa fa-warning"></i></button></a>
                                    <a href='{{ url('/reset-password-active-directory/'.$info[$i]["samaccountname"][0].'') }}' onclick='show()'><button title='Reset Password' class="btn btn-outline btn-success  dim" type="button"><i class="fa fa-history"></i></button></a>
                                    @endif
                                    @endif
                                </td>
                            </tr>
                            @endfor   
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </div>
</div>
<script>
    
    function showDetails(username)
    {
        $("#edit_account").modal();
        document.getElementById("myDiv").style.display="block";
        $.ajax(
        {    //create an ajax request to load_page.php
            
            type: "GET",
            url: "{{ url('/get-account-details') }}",            
            data:
            {
                "username" : username,
            }     ,
            dataType: "json",   //expect html to be returned
            success: function(data)
            {
               $("#company").remove();
               $("#department").remove();
                document.getElementById("edit_first_name").value = data[0].givenname[0];
                document.getElementById("edit_surname").value = data[0].sn[0];
                if(data[0].mail != null)
                {
                    document.getElementById("edit_email").value = data[0].mail[0];
                }
                else
                {
                    document.getElementById("edit_email").value = "";
                }
                if(data[0].title[0] != null)
                {
                    document.getElementById("edit_email").value = data[0].mail[0];
                }
                else
                {
                    document.getElementById("edit_email").value = "";
                }
                document.getElementById("edit_title").value = data[0].title[0];
                document.getElementById("edit_description").value = data[0].description[0];
                document.getElementById("edit_location").value = data[0].physicaldeliveryofficename[0];
                var company = "<div id='company' class=' col-md-12'> Company :<select class='form-control chosen-select' data-placeholder='Choose Company' id='company_edit'  name='company' required>";
                    company += "<option></option>@foreach($companies as $company) <option value='{{$company->name}}' >{{$company->name}}</option> @endforeach</select></div>";
                   
                $(".company").append(company);  
                // document.getElementById("company_edit").value = data[0].company[0];  
                var department = "   Department : <select class='form-control chosen-select' data-placeholder='Choose a Department...' id='edit_department'  name='department'  required>";
                    company += "<option></option>@foreach($companies as $company) <option value='{{$company->name}}' >{{$company->name}}</option> @endforeach</select>";
                   
                $(".company").append(company);  
                // document.getElementById("company_edit").value = data[0].company[0];         
                var company = "<div id='company' class=' col-md-12'> Company :<select class='form-control chosen-select' data-placeholder='Choose Company' id='company_edit'  name='company' required>";
                    company += "<option></option>@foreach($companies as $company) <option value='{{$company->name}}' >{{$company->name}}</option> @endforeach</select>";
                   
                $(".company").append(company);  
                // document.getElementById("company_edit").value = data[0].company[0];                      
                $('<link/>', {rel: 'stylesheet',type: 'text/css',href: '{{ asset('bootstrap/css/plugins/chosen/bootstrap-chosen.css') }}'}).appendTo('head');
                var chosen_js = '{{ asset('bootstrap/js/plugins/chosen/chosen.jquery.js') }}';        
                $.getScript(chosen_js,function(jd) {$('.chosen-select').chosen({width: "100%"}); });     
          
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
@endsection
