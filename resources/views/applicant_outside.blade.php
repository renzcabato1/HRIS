@extends('layouts.header_applicant')
@section('content')
<div class="row" style="height:100%;">
    <div class="col-lg-12">
        <div class="ibox " style="height:100%;">
            <div class="ibox-title">
                <h5></h5>
                <a href='{{url('/applicant-walk-in')}}'  onclick='show()'><button type="button" class="btn btn-w-m btn-primary" ><i class="fa fa-arrow-circle-o-left"></i> Back </button></a>
            </div>
            <div class="ibox-content" style='height:100%;' >
                <h2>
                    {{-- Job Title: {{$position_available->position_info->job_title}} --}}
                </h2>
                @if(session()->has('status'))
                <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    {{session()->get('status')}}
                </div>
                @endif
                <form id="form" action='' onsubmit='show();'  method="POST"  class="wizard-big" style='overflow-y: auto;' enctype="multipart/form-data"  >
                    {{ csrf_field() }}
                    <h1>Contact Info</h1>
                    <fieldset>
                       <i style='color:red'> Note: Your profile is the first thing recruiters see and not your uploaded resume, so make sure your profile is as complete and detailed as your uploaded resume.</i>
                        <h2>Account Information</h2>
                        
                        <div class="form-group row">
                            <div class="col-lg-1">
                                <img id='avatar' src="{{URL::asset('/images/no_image.png')}}" class="rounded-circle circle-border m-b-md border" alt="profile" height='75px;' width='75px;'>
                            </div>
                            <div class="col-lg-8">
                                <label title="Upload image file" for="inputImage" class="btn btn-primary">
                                    <input type="file" accept="image/*" name="file" id="inputImage" style="display:none" onchange='uploadimage(this)'>
                                    Upload image
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-1 col-form-label">Name<span style='color:red;'>*</span></label>
                            <div class="col-lg-3">
                                <input type="text" placeholder="First Name" name='first_name' class="form-control required"> 
                            </div>
                            <div class="col-lg-2">
                                <input type="text" placeholder="Middle Name" name='midle_name' class="form-control "> 
                            </div>
                            <div class="col-lg-1">
                                <input type="text" placeholder="M.I." name='midle_initials' class="form-control "> 
                            </div>
                            <div class="col-lg-4">
                                <input type="text" placeholder="Last Name" name='last_name' class="form-control required"> 
                            </div>
                            <div class="col-lg-1">
                                <input type="text" placeholder="Suffix" name='suffix' class="form-control"> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-1 col-form-label">Email<span style='color:red;'>*</span></label>
                            <div class="col-lg-5"><input type="email" placeholder="Email" name='email' class="form-control required email"> 
                            </div>
                            <div class="col-lg-3">
                                <select class='form-control required' name='marital_status' required>
                                    <option value=''>--Select Marital Status--</option>
                                    @foreach($marital_statuses as $marital_status)
                                        <option value='{{$marital_status->name}}'>{{$marital_status->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <input type="text" placeholder="Religion" name='religion' class="form-control required"> 
                            </div>
                        </div>
                        <div class="form-group row"><label class="col-lg-1 col-form-label">Address<span style='color:red;'>*</span></label>
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label class="font-normal">Region<span style='color:red;'>*</span></label>
                                    <select data-placeholder="Choose Region" name="region" class="form-control required" onchange='selectRegion(this.value)'  tabindex="2">
                                        <option value=""></option>
                                        @foreach($regions as $region)
                                        <option value="{{$region->id}}">{{$region->region_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="font-normal">City<span style='color:red;'>*</span></label>
                                    <div id = "contactInfoLoading" style="display:none;" class="loader">
                                    </div>
                                    <div id='city-select' class='city'>
                                        
                                        <select id='city' data-placeholder="Choose City" name="city" class="form-control required" >
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row"><label class="col-lg-1 col-form-label"></label>
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label class="font-normal">Current Address<span style='color:red;'>*</span></label>
                                    <div>
                                        <input type="text" placeholder="Current Address" name='street_address' class="form-control"> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="font-normal">Permanent Address<span style='color:red;'>*</span></label>
                                    <div>
                                        <input type="text" placeholder="Permanent Address" name='permanent_address' class="form-control"> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row"><label class="col-lg-1 col-form-label">Birthday</label>
                            <div class="col-lg-2"> 
                                <select data-placeholder="Year" class="form-control required" name='birthYear' >
                                    <option value="">Year</option>
                                    
                                    @for ($i = date('Y')-15; $i >= date('Y')-100; $i--)
                                    <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                    
                                </select>
                            </div>
                            <div class="col-lg-2"> 
                                <select data-placeholder="Month" class="form-control required" name='birthMonth' onchange='selectMonth(this.value)'>
                                    <option value="">Month</option>
                                    
                                    @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{$i}}">{{date('M', mktime(0, 0, 0, $i, 1))}}</option>
                                    @endfor
                                    
                                </select>
                            </div>
                            <div class="col-lg-2 birthday"> 
                                <select data-placeholder="Day" class="form-control required" name='birthDay'>
                                    <option value="">Day</option>
                                    
                                    @for ($i = 1; $i <= 31; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                    
                                </select>
                            </div>
                            <label class="col-lg-1 col-form-label text-right">Gender</label>
                            <div class="col-lg-4"> 
                                <select data-placeholder="Gender" class="form-control required" name='gender' >
                                    <option value=""></option>
                                    <option value="MALE">MALE</option>
                                    <option value="FEMALE">FEMALE</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" > 
                            <label class="col-lg-1 col-form-label ">Mobile<span style='color:red;'>*</span></label>
                            <div class="col-lg-4"> 
                                <input type="text" placeholder="" type="text"  name="phone_number" class="form-control required"name='phoneNumber' class="form-control"> 
                                {{-- <span class="form-text">(0965) XXX-XXXX</span> --}}
                            </div>
                            <label class="col-lg-3 col-form-label text-right">Landline(optional)</label>
                            <div class="col-lg-4"> 
                                <input type="text" placeholder="" type="text"name="telephone_number" class="form-control" name='telNumber' class="form-control"> 
                                {{-- <span class="form-text">XXX-XXXX</span> --}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-1 col-form-label">Hobbies and Interests</label>
                            <div class="col-lg-5"> 
                            <link href="{{ asset('bootstrap/css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet">
                                <style>
                                    .bootstrap-tagsinput input[type="text"] 
                                    {
                                        width:100%;
                                    }
                                </style>
                                <input class="" data-role="tagsinput" type="text" name='hobbies' value="Painting,Socializing,Dancing,Reading,Writing,Computer"/>
                                <script src="{{ asset('bootstrap/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
                            </div>
                            <label class="col-lg-2 col-form-label text-right">How did you know us?</label>
                            <div class="col-lg-4"> 
                                {{-- <input type="text" placeholder="" type="text"  >  --}}
                                <select name="how_did_you_know_us" class="form-control required" >
                                    <option></option>
                                    <option value='LinkedIn'>LinkedIn</option>
                                    <option value='Jobstreet'>Jobstreet</option>
                                    <option value='Kalibrr'>Kalibrr</option>
                                    <option value='BestJobs'>BestJobs</option>
                                    <option value='Indeed'>Indeed</option>
                                    <option value='Facebook'>Facebook</option>
                                    <option value='Instagram'>Instagram</option>
                                    <option value='Employee Referral'>Employee Referral</option>
                                    <option value='Other'>Other</option>
                                </select>
                                {{-- <span class="form-text">(0965) XXX-XXXX</span> --}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-1 col-form-label">Skills</label>
                            <div class="col-lg-5"> 
                            <link href="{{ asset('bootstrap/css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet">
                                <style>
                                    .bootstrap-tagsinput input[type="text"] 
                                    {
                                        width:100%;
                                    }
                                </style>
                                <input class="" data-role="tagsinput" type="text" name='skills' value="Communication,Teamwork,Adaptability,Problem-Solving,Creativity" />
                                <script src="{{ asset('bootstrap/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
                            </div>
                           
                        </div>
                    </fieldset>
                    <h1>Work Experience</h1>
                    <fieldset>
                        <i style='color:red'> Note: Your profile is the first thing recruiters see and not your uploaded resume, so make sure your profile is as complete and detailed as your uploaded resume.</i>
                       
                        <div class='work-experience'>
                        </div>
                        <button class="btn btn-primary" onclick='addExperience()' type="button"><i class="fa fa-plus-square-o"></i>&nbsp;Add Work Experience</button>
                    </fieldset>
                    <h1>Education</h1>
                    <fieldset>
                        <i style='color:red'> Note: Your profile is the first thing recruiters see and not your uploaded resume, so make sure your profile is as complete and detailed as your uploaded resume.</i>
                       
                        <div class='education'>
                        </div>
                        <button class="btn btn-primary" onclick='addEducation()' type="button"><i class="fa fa-plus-square-o"></i>&nbsp;Add Education</button>
                    </fieldset>
                    {{-- <h1>Government Information</h1>
                    <fieldset>
                        <i style='color:red'> Note: Your profile is the first thing recruiters see and not your uploaded resume, so make sure your profile is as complete and detailed as your uploaded resume.</i>
                       
                        <div class='education'>
                        </div>
                        <button class="btn btn-primary" onclick='addEducation()' type="button"><i class="fa fa-plus-square-o"></i>&nbsp;Add Education</button>
                    </fieldset> --}}
                    <h1>Finish</h1>
                    <fieldset>
                        <i style='color:red'> Note: Your profile is the first thing recruiters see and not your uploaded resume, so make sure your profile is as complete and detailed as your uploaded resume.</i>
                       
                        <div class='form-group row'>
                            <div class='col-lg-3'>
                            </div>
                            <div class='col-lg-6'>
                                <label class="font-normal">Upload Resume</label>
                                <input class='form-control required' name='resume' type='file' >
                            </div>
                        </div>
                        {!! nl2br(e($consent->consent))!!}
                        <input id="acceptTerms" name="acceptTerms" type="checkbox" required> <label for="acceptTerms">I agree with Consent Notice.</label>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
function selectRegion(regionId)
{
document.getElementById("contactInfoLoading").style.display="block";
$('.city').children().remove();
$.ajax({ 

type: "GET",
url: "{{ url('/get-city') }}",            
data: {
"regionId" : regionId,
}     ,
dataType: "json",   //expect html to be returned
success: function(data)
{ 
$('.city').append('<select id="city" data-placeholder="Choose City" class="form-control"  name="city" tabindex="2"><option value=""  ></option>');
jQuery.each(data, function(key) {
$('#city').append('<option value='+ data[key].id +' >'+ data[key].city_name +'</option>');

});
$('.city').append('</select>');

document.getElementById("contactInfoLoading").style.display="none";

},
error: function(e)
{
console.log(e);
document.getElementById("contactInfoLoading").style.display="none";
}
});
}
function selectMonth(month)
{
if((month == 1) || (month == 3) || (month == 5) || (month == 7) || (month == 8) || (month == 10) || (month == 12) )
{
document.getElementById("contactInfoLoading").style.display="block";
$('.birthday').children().remove();
$('.birthday').append('<select id="birthday"  data-placeholder="Day" class="form-control required" name="birthDay"><option value=""  ></option>');
for (var i =1; i <= 31; i++ )
$('#birthday').append('<option value='+ i +' >'+ i +'</option>');


$('.birthday').append('</select>');

document.getElementById("contactInfoLoading").style.display="none";
}
else if(month == 2)
{
document.getElementById("contactInfoLoading").style.display="block";
$('.birthday').children().remove();
$('.birthday').append('<select id="birthday"  data-placeholder="Day" class="form-control required" name="birthDay"><option value=""  ></option>');
for (var i =1; i <= 29; i++ )
$('#birthday').append('<option value='+ i +' >'+ i +'</option>');


$('.birthday').append('</select>');

document.getElementById("contactInfoLoading").style.display="none";
}
else
{
document.getElementById("contactInfoLoading").style.display="block";
$('.birthday').children().remove();
$('.birthday').append('<select id="birthday"  data-placeholder="Day" class="form-control required" name="birthDay"><option value=""  ></option>');
for (var i =1; i <= 30; i++ )
$('#birthday').append('<option value='+ i +' >'+ i +'</option>');


$('.birthday').append('</select>');

document.getElementById("contactInfoLoading").style.display="none";
}
}
function addExperience()
{     
var idBusinessUnit = $('.work-experience').children().last().attr('id');

if(idBusinessUnit == undefined)
{
var idBusinessUnit =  1;
}
else
{
var idBusinessUnit = parseInt(idBusinessUnit) + 1;
}

var newBusinessUnit = "<div id = '"+idBusinessUnit+"'>";
newBusinessUnit += "<div class='form-group row'><div class='col-lg-1'> <button title='remove' onclick='removeWorkExperience("+idBusinessUnit+")' class='btn btn-outline btn-danger' type='button'><i class='fa fa-times-rectangle'></i></button></div><div class='col-lg-2'><h2 >Work experience </h2></div></div>";
newBusinessUnit += "<hr>";
newBusinessUnit += " <div class='form-group row'>";
newBusinessUnit += "<label class='col-lg-1 col-form-label'>Job Title<span style='color:red;'>*</span></label>";
newBusinessUnit += "<div class='col-lg-5'>";
newBusinessUnit += "<input type='text' placeholder='Job Title' id='job-title-"+idBusinessUnit+"' name='job_title[]' class='form-control required'>";
newBusinessUnit += "</div>";
newBusinessUnit += "<label class='col-lg-1 col-form-label'>Company<span style='color:red;'>*</span></label>";
newBusinessUnit += "<div class='col-lg-5'>";
newBusinessUnit += "<input type='text' placeholder='Company' name='company[]' id='company-"+idBusinessUnit+"' class='form-control required'> ";
newBusinessUnit += "</div>";
newBusinessUnit += "</div>";
newBusinessUnit += "<div class='form-group row'>";
newBusinessUnit += "<label class='col-lg-1 col-form-label'>From <span style='color:red;'>*</span></label>";
newBusinessUnit += " <div class='col-lg-2'>";
newBusinessUnit += "<select data-placeholder='Month' id='startMonth-"+idBusinessUnit+"' class='form-control required' name='monthStartWork[]' >";
newBusinessUnit += "<option value=''>Month</option>";
newBusinessUnit += " @for ($i = 1; $i <= 12; $i++)";
newBusinessUnit += "<option value='{{$i}}'>{{date('M', mktime(0, 0, 0, $i, 1))}}</option>";
newBusinessUnit += "@endfor";
newBusinessUnit += "</select>";
newBusinessUnit += "</div>";
newBusinessUnit += "<div class='col-lg-2'>";
newBusinessUnit += "<input type='text' class='form-control required' id='yearStart-"+idBusinessUnit+"' required' data-mask='9999' max='{{date('Y')}}' placeholder='Year' name='yearworkstart[]'>";
newBusinessUnit += "</div>";
newBusinessUnit += "<label class='col-lg-1 col-form-label'></label>";
newBusinessUnit += "<label class='col-lg-1 col-form-label >To <span style='color:red;'>*</span></label>";
newBusinessUnit += "<div class='col-lg-2'>";
newBusinessUnit += "<select data-placeholder='Month' id='monthEnd-"+idBusinessUnit+"' class='form-control required present"+idBusinessUnit+"' name='monthEndWork[]' >";
newBusinessUnit += "<option value=''>Month</option>";
newBusinessUnit += "@for ($i = 1; $i <= 12; $i++)";
newBusinessUnit += "<option value='{{$i}}'>{{date('M', mktime(0, 0, 0, $i, 1))}}</option>";
newBusinessUnit += "@endfor";
newBusinessUnit += " </select>";
newBusinessUnit += "</div>";
newBusinessUnit += "<div class='col-lg-1 '>";
newBusinessUnit += "<input type='text' class='form-control required present"+idBusinessUnit+"' id='yearEnd-"+idBusinessUnit+"' data-mask='9999' max='{{date('Y')}}' placeholder='Year' name='yearworkend[]'>";
newBusinessUnit += "</div></span>";
newBusinessUnit += "<div class='col-lg-2'>";
newBusinessUnit += "<label><input type='checkbox' onclick='currently_work("+idBusinessUnit+")' id='to-present-"+idBusinessUnit+"' value=''>I currently work here</label>";
newBusinessUnit += "</div>";
newBusinessUnit += "</div>";
newBusinessUnit += "<div class='form-group row'>";
newBusinessUnit += "<label class='col-lg-1 col-form-label'>Job Level <span style='color:red;'>*</span></label>";
newBusinessUnit += " <div class='col-lg-5'>";
newBusinessUnit += "<select data-placeholder='' id='joblevel-"+idBusinessUnit+"' class='form-control required' name='job_level[]' >";
newBusinessUnit += "<option></option>";
newBusinessUnit += "@foreach ($job_levels as $job_level)";
newBusinessUnit += "<option value='{{$job_level->level}}'>{{$job_level->level}}</option>";
newBusinessUnit += " @endforeach";
newBusinessUnit += "</select>";
newBusinessUnit += "</div>";
newBusinessUnit += "<label class='col-lg-1 col-form-label'>Job Function <span style='color:red;'>*</span></label>";
newBusinessUnit += "<div class='col-lg-5'>";
newBusinessUnit += "<select data-placeholder='' id='job-function-"+idBusinessUnit+"' class='form-control required' name='job_function[]' >";
newBusinessUnit += "<option></option>";
newBusinessUnit += "@foreach ($job_functions as $job_function)";
newBusinessUnit += "<option value='{{$job_function->functions}}'>{{$job_function->functions}}</option>";
newBusinessUnit += "@endforeach";
newBusinessUnit += "</select>";
newBusinessUnit += "</div></div><div class='form-group row'> ";
newBusinessUnit += "<label class='col-lg-1 col-form-label'>Reason for leaving <span style='color:red;'>*</span></label>";
newBusinessUnit += "<div class='col-lg-5'>";
newBusinessUnit += "<input class='form-control required' name='reason_for_leaving'> ";
newBusinessUnit += "</div>";
newBusinessUnit += "</div> ";
newBusinessUnit += " <hr>";
newBusinessUnit += " </div>";


$(".work-experience").append(newBusinessUnit);  
}
function removeWorkExperience(idBusinessUnit)
{

$("#"+idBusinessUnit).remove();
}
function addEducation()
{
var idEducation = $('.education').children().last().attr('id');

if(idEducation == undefined)
{
var idEducation =  1;
}
else
{
var res = idEducation.split("-");
var idEducation = parseInt(res[1]) + 1;
}
var newEducation = "<div id='ed-"+idEducation+"'>";
newEducation += "<hr>";
newEducation += "<div class='form-group row'><div class='col-lg-1'> <button title='remove' onclick='removeEducation("+idEducation+")' class='btn btn-outline btn-danger' type='button'><i class='fa fa-times-rectangle'></i></button></div><div class='col-lg-2'><h2 >Education </h2></div></div>";
newEducation += " <div class='form-group row'>";
newEducation += "<label class='col-lg-2 col-form-label'>Educational attainment<span style='color:red;'>*</span></label>";
newEducation += "<div class='col-lg-4'>";
newEducation += "<select id='educ-attainment-"+idEducation+"' name='educAttainment[]' class='form-control required'>";
newEducation += "<option></option>";
newEducation += "@foreach ($education_attainments as $attainment)";
newEducation += "<option value='{{$attainment->attainment}}'>{{$attainment->attainment}}</option>";
newEducation += " @endforeach";
newEducation += "</select>";
newEducation += "</div>";
newEducation += "<label class='col-lg-2 col-form-label'>School/University <span style='color:red;'>*</span></label>";
newEducation += "<div class='col-lg-4'>";
newEducation += "<input type='text' placeholder='School/University' name='schoolUniversity[]' id='schoolUniversity-"+idEducation+"' class='form-control required'> ";
newEducation += "</div>";
newEducation += "</div>";
newEducation += " <div class='form-group row'>";
newEducation += "<label class='col-lg-2 col-form-label'>Course (optional)</label>";
newEducation += "<div class='col-lg-10'>";
newEducation += "<input type='text' placeholder='Course' name='course[]' id='course-"+idEducation+"' class='form-control' required> ";
newEducation += "</div>";
newEducation += "</div>";
newEducation += "<div class='form-group row'>";
newEducation += "<label class='col-lg-2 col-form-label'>Start date <span style='color:red;'>*</span></label>";
newEducation += " <div class='col-lg-2'>";
newEducation += "<select data-placeholder='Month' id='startMonth-"+idEducation+"' class='form-control required' name='start_educ[]' >";
newEducation += "<option value=''>Month</option>";
newEducation += " @for ($i = 1; $i <= 12; $i++)";
newEducation += "<option value='{{$i}}'>{{date('M', mktime(0, 0, 0, $i, 1))}}</option>";
newEducation += "@endfor";
newEducation += "</select>";
newEducation += "</div>";
newEducation += "<div class='col-lg-2'>";
newEducation += "<input type='text' class='form-control required' id='yearStart-"+idEducation+"' required' data-mask='9999' max='{{date('Y')}}' placeholder='Year ' name='year_start_educ[]'>";
newEducation += "</div>";
newEducation += "<label class='col-lg-2 col-form-label'>End date (or expected date of graduation)</label>";
newEducation += "<div class='col-lg-2'>";
newEducation += "<select  data-placeholder='Month' id='monthEnd-"+idEducation+"' class='form-control required' name='end_educ[]' >";
newEducation += "<option value=''>Month</option>";
newEducation += "@for ($i = 1; $i <= 12; $i++)";
newEducation += "<option value='{{$i}}'>{{date('M', mktime(0, 0, 0, $i, 1))}}</option>";
newEducation += "@endfor";
newEducation += " </select>";
newEducation += "</div>";
newEducation += "<div class='col-lg-2'>";
newEducation += "<input type='text' class='form-control required' id='yearEnd-"+idEducation+"' data-mask='9999' max='{{date('Y')}}' placeholder='Year' name='year_end_educ[]'>";
newEducation += "</div>";
newEducation += "</div> ";
newEducation += "<div class='form-group row'>";
newEducation += "<label class='col-lg-2 col-form-label'>Accomplishments or descriptions (optional) </label>";
newEducation += " <div class='col-lg-10'>";
newEducation += "<textarea class='form-control' placeholder='e.g. Valedictorian, Honorable Mentions, etc.'' id='accomplishments-"+idEducation+"' name='accomplishment[]'></textarea>";
newEducation += "</div>";
newEducation += "</div>";
newEducation += "<hr>";
newEducation += "</div>";

$(".education").append(newEducation);  

}
function removeEducation(idEducation)
{
    // alert(idEducation);
$("#ed-"+idEducation).remove();
}

function goBack() {
window.history.back();
}
function uploadimage(input)
{
// alert({{$regions}});
if (input.files && input.files[0]) {
var reader = new FileReader();

reader.onload = function(e) {
$('#avatar').attr('src', e.target.result);
}

reader.readAsDataURL(input.files[0]);
}
}
function currently_work(work)
{
    $(".present"+work).remove();
}
</script>
@endsection