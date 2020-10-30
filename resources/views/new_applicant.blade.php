@extends('layouts.header')

@section('content')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        
        
        <div class="col-lg-8">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Contact Info</h5>
                    
                </div>
                <div class="ibox-content">
                    
                    {{-- <p>Sign in today for more expirience.</p> --}}
                    <div class="form-group row">
                        <div class="col-lg-2">
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
                        <label class="col-lg-2 col-form-label">Name<span style='color:red;'>*</span></label>
                        
                        <div class="col-lg-6">
                            <input type="text" placeholder="First Name" name='first_name' class="form-control"> 
                        </div>
                        <div class="col-lg-4">
                            <input type="text" placeholder="Last Name" name='last_name' class="form-control"> 
                        </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-2 col-form-label">Email<span style='color:red;'>*</span></label>
                        
                        <div class="col-lg-10"><input type="email" placeholder="Email" name='email' class="form-control"> 
                        </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-2 col-form-label">Address<span style='color:red;'>*</span></label>
                        
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="font-normal">Region<span style='color:red;'>*</span></label>
                                <div>
                                    <select data-placeholder="Choose Region" class="chosen-select" onchange='selectRegion(this.value)'  tabindex="2">
                                        <option value=""></option>
                                        @foreach($regions as $region)
                                        <option value="{{$region->id}}">{{$region->region_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="font-normal">City<span style='color:red;'>*</span></label>
                                <div id = "contactInfoLoading" style="display:none;" class="loader">
                                </div>
                                <div id='city-select' class='city'>
                                    
                                    <select id='city' data-placeholder="Choose City" class="chosen-select"  tabindex="2">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-2 col-form-label"></label>
                        <div class="col-lg-10">
                            <div class="form-group">
                                <label class="font-normal">Street address<span style='color:red;'>*</span></label>
                                <div>
                                    <input type="text" placeholder="Street Address" name='last_name' class="form-control"> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-2 col-form-label">Birthday</label>
                        
                        <div class="col-lg-2"> 
                            <select data-placeholder="Year" class="chosen-select" name='birthYear' >
                                <option value=""></option>
                                
                                @for ($i = date('Y')-15; $i >= date('Y')-100; $i--)
                                <option value="{{$i}}">{{$i}}</option>
                                @endfor
                                
                            </select>
                        </div>
                        <div class="col-lg-2"> 
                            <select data-placeholder="Month" class="chosen-select" name='birthMonth' onchange='selectMonth(this.value)'>
                                <option value=""></option>
                                
                                @for ($i = 1; $i <= 12; $i++)
                                <option value="{{$i}}">{{date('F', mktime(0, 0, 0, $i, 1))}}</option>
                                @endfor
                                
                            </select>
                        </div>
                        <div class="col-lg-2 birthday"> 
                            <select data-placeholder="Day" class="chosen-select" name='birthDay'>
                                <option value=""></option>
                                
                                @for ($i = 1; $i <= 31; $i++)
                                <option value="{{$i}}">{{$i}}</option>
                                @endfor
                                
                            </select>
                        </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-2 col-form-label">Gender</label>
                        <div class="col-lg-3"> 
                            <select data-placeholder="Gender" class="chosen-select" name='gender' >
                                <option value=""></option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-2 col-form-label">Phone<span style='color:red;'>*</span></label>
                        <div class="col-lg-5"> 
                            <input type="text" placeholder="" type="text" data-mask="(9999) 999-9999" class="form-control" data-mask="(999) 999-9999" name='phoneNumber' class="form-control"> 
                            <span class="form-text">(0965) XXX-XXXX</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            {{-- <div class="row mb-2">
                <div class="col-lg-12">
                    <div class="ibox-title">
                        <h5>Salary Expectation</h5>
                        
                    </div>
                    <div class="ibox-content">
                        <button class="btn btn-block btn-outline btn-primary" onclick='addSalary()'><i class="fa fa-plus-circle"></i> Add salary expectation</button>
                    </div>
                </div>
            </div> --}}
            <div class="row row mb-2">
                <div class="col-lg-12">
                    <div class="ibox-title">
                        <h5>Work Experience</h5>
                        
                    </div>
                    <div class="ibox-content">
                        <button class="btn btn-block btn-outline btn-primary" onclick='addWorkExperience()'><i class="fa fa-plus-circle"></i> Add work experience</button>
                    </div>
                </div>
            </div>
            <div class="row row mb-2">
                <div class="col-lg-12">
                    <div class="ibox-title">
                        <h5>Education</h5>
                    </div>
                    <div class="ibox-content">
                        <button class="btn btn-block btn-outline btn-primary" onclick='addEducation()'><i class="fa fa-plus-circle"></i> Add education</button>
                    </div>
                </div>
            </div>
            {{-- <div class="row row mb-2">
                <div class="col-lg-12">
                    <div class="ibox-title">
                        <h5>Skills</h5>
                    </div>
                    <div class="ibox-content">
                        <button class="btn btn-block btn-outline btn-primary" onclick='addSkills()'><i class="fa fa-plus-circle"></i> Add skills</button>
                    </div>
                </div>
            </div>
            <div class="row row mb-2">
                <div class="col-lg-12">
                    <div class="ibox-title">
                        <h5>Awards and achievements</h5>
                    </div>
                    <div class="ibox-content">
                        <button class="btn btn-block btn-outline btn-primary" onclick='addAwards()'><i class="fa fa-plus-circle"></i> Add award or achievement</button>
                    </div>
                </div>
            </div> --}}
            <div class="row mb-2">
                <div class="col-lg-12">
                    <div class="ibox-title">
                        <h5>Resume</h5>
                        
                    </div>
                    <div class="ibox-content">
                        <button class="btn btn-block btn-outline btn-primary" onclick='addResume()'><i class="fa fa-plus-circle"></i> Upload resume</button>
                        <ol>
                            <li>We recommend using the latest version of Google Chrome or Mozilla Firefox to upload your file. </li>
                            <li>Acceptable file types are DOC, DOCX, PDF, and RTF.</li>
                            <li>Max file size is 10 MB.</li>
                           
                        </ol>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-lg-12">
                        <button class="btn btn-primary " type="submit"><i class="fa fa-check"></i>&nbsp;Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
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
            $('.city').append('<select id="city" data-placeholder="Choose City" class="chosen-select"  tabindex="2"><option value=""  ></option>');
                jQuery.each(data, function(key) {
                    $('#city').append('<option value='+ data[key].id +' >'+ data[key].city_name +'</option>');
                    
                });
                $('.city').append('</select>');
                $('<link/>', {
                    rel: 'stylesheet',
                    type: 'text/css',
                    href: '{{ asset('bootstrap/css/plugins/chosen/bootstrap-chosen.css') }}'
                }).appendTo('head');
                var chosen_js = '{{ asset('bootstrap/js/plugins/chosen/chosen.jquery.js') }}';        
                $.getScript(chosen_js,function(jd) {
                    $('.chosen-select').chosen({width: "100%"});
                });                
                document.getElementById("contactInfoLoading").style.display="none";
                
            },
            error: function(e)
            {
                alert(e);
            }
        });
    }
        function selectMonth(month)
        {
            if((month == 1) || (month == 3) || (month == 5) || (month == 7) || (month == 8) || (month == 10) || (month == 12) )
            {
                document.getElementById("contactInfoLoading").style.display="block";
                $('.birthday').children().remove();
                $('.birthday').append('<select id="birthday"  data-placeholder="Day" class="chosen-select" name="birthDay"><option value=""  ></option>');
                    for (var i =1; i <= 31; i++ )
                    $('#birthday').append('<option value='+ i +' >'+ i +'</option>');
                    
                    
                    $('.birthday').append('</select>');
                    $('<link/>', {
                        rel: 'stylesheet',
                        type: 'text/css',
                        href: '{{ asset('bootstrap/css/plugins/chosen/bootstrap-chosen.css') }}'
                    }).appendTo('head');
                    var chosen_js = '{{ asset('bootstrap/js/plugins/chosen/chosen.jquery.js') }}';        
                    $.getScript(chosen_js,function(jd) {
                        $('.chosen-select').chosen({width: "100%"});
                    });                
                    document.getElementById("contactInfoLoading").style.display="none";
                }
                else if(month == 2)
                {
                    document.getElementById("contactInfoLoading").style.display="block";
                    $('.birthday').children().remove();
                    $('.birthday').append('<select id="birthday"  data-placeholder="Day" class="chosen-select" name="birthDay"><option value=""  ></option>');
                        for (var i =1; i <= 28; i++ )
                        $('#birthday').append('<option value='+ i +' >'+ i +'</option>');
                        
                        
                        $('.birthday').append('</select>');
                        $('<link/>', {
                            rel: 'stylesheet',
                            type: 'text/css',
                            href: '{{ asset('bootstrap/css/plugins/chosen/bootstrap-chosen.css') }}'
                        }).appendTo('head');
                        var chosen_js = '{{ asset('bootstrap/js/plugins/chosen/chosen.jquery.js') }}';        
                        $.getScript(chosen_js,function(jd) {
                            $('.chosen-select').chosen({width: "100%"});
                        });                
                        document.getElementById("contactInfoLoading").style.display="none";
                    }
                    else
                    {
                        document.getElementById("contactInfoLoading").style.display="block";
                        $('.birthday').children().remove();
                        $('.birthday').append('<select id="birthday"  data-placeholder="Day" class="chosen-select" name="birthDay"><option value=""  ></option>');
                            for (var i =1; i <= 30; i++ )
                            $('#birthday').append('<option value='+ i +' >'+ i +'</option>');
                            
                            
                            $('.birthday').append('</select>');
                            $('<link/>', {
                                rel: 'stylesheet',
                                type: 'text/css',
                                href: '{{ asset('bootstrap/css/plugins/chosen/bootstrap-chosen.css') }}'
                            }).appendTo('head');
                            var chosen_js = '{{ asset('bootstrap/js/plugins/chosen/chosen.jquery.js') }}';        
                            $.getScript(chosen_js,function(jd) {
                                $('.chosen-select').chosen({width: "100%"});
                            });                
                            document.getElementById("contactInfoLoading").style.display="none";
                        }
                    }
                    function addSalary()
                    {
                        
                    }
                </script>
                @endsection
                