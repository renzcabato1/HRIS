<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <link rel="shortcut icon" href="{{ asset('/images/logo.ico')}}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    
    <!-- Styles -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <!-- FooTable -->
    <link href="{{ asset('bootstrap/css/plugins/footable/footable.core.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/plugins/blueimp/css/blueimp-gallery.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/plugins/chosen/bootstrap-chosen.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/plugins/switchery/switchery.css') }}" rel="stylesheet">

    <link href="{{ asset('bootstrap/css/plugins/jasny/jasny-bootstrap.min.css') }}" rel="stylesheet">
    
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        
        /* Firefox */
        input[type=number] {
            -moz-appearance:textfield;
        }
        .loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url("{{ asset('/images/3.gif')}}") 50% 50% no-repeat rgb(249,249,249) ;
            opacity: .8;
            background-size:200px 120px;
        }
        
    </style>
</head>
<body >
    @php
    ini_set('memory_limit', '-1');
    @endphp
    <div id="wrapper">
        <div id = "myDiv" style="display:none;" class="loader">
        </div>
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <img alt="image" class="rounded-circle" style='width:48px;height:48px;' src="{{'http://10.96.4.40:8441/hrportal/public/id_image/employee_image/'.Auth::user()->employee_info()->id.'.png'}}"/>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="block m-t-xs font-bold">{{Auth::user()->employee_info()->first_name.' '.Auth::user()->employee_info()->last_name}}</span>
                                <span class="text-muted text-xs block">{{Auth::user()->employee_info()->position}} <b class="caret"></b></span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a class="dropdown-item" href="profile.html">Profile</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}"  onclick="logout(); show();">Logout</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            HRIS
                        </div>
                    </li>

                    @php
                        $roles = auth()->user()->role_info();
                        $roles = $roles->pluck('role_id')->toArray();
                    @endphp

                    @if(in_array(1,$roles))
                    <li @if($header == 'Home') class='active' @endif>
                        <a href="{{ url('/') }}" class='active' onclick='show()' ><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span> </a>
                    </li>
                    <li @if($header == 'Dashboard Employee') class='active' @endif>
                        <a href="{{ url('/headlines') }}" class='active' onclick='show()' ><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard Employee</span> </a>
                    </li>
                    <li @if($header == 'Manpower Request') class='active' @endif  >
                        
                        <a href="{{ url('/manpower-request') }}"  onclick='show()'><i class="fa fa fa-user-circle-o"></i> <span class="nav-label">Manpower Request</span></a>
                    </li>
                    <li @if($header == 'Recruitment') class='active' @endif  >
                        <a href="#"><i class="fa fa-plus-square-o"></i> <span class="nav-label">Recruitment</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            
                            <li @if($subheader == 'Applicants') class='active' @endif><a href="{{ url('/applicants') }}">Applicants</a></li>
                            <li  @if($subheader == 'For Interview') class='active' @endif><a href="{{ url('/for-interview') }}">For Interview</a></li>
                            <li @if($subheader == 'For Requirements') class='active' @endif><a href="{{ url('/for-requirements') }}" onclick='show()'>For Requirements</a></li>
                        </ul>
                    </li>
                    <li @if($header == 'On-boarding') class='active' @endif >
                        <a href="#"><i class="fa fa-handshake-o"></i> <span class="nav-label">On-boarding</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li @if($subheader == 'Active Directory') class='active' @endif><a href="{{ url('/active-directory') }}">Active Directory</a></li>
                            
                        </ul>
                    </li>
                    <li @if($header == 'Settings') class='active' @endif>
                        <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">Settings</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li @if($subheader == 'Positions') class='active' @endif><a href="{{ url('/positions') }}">Positions</a></li> 
                        </ul>
                        <ul class="nav nav-second-level collapse">
                            <li @if($subheader == 'Accounts') class='active' @endif><a href="{{ url('/accounts') }}">Accounts</a></li> 
                        </ul>
                        <ul class="nav nav-second-level collapse">
                            <li @if($subheader == 'Exams') class='active' @endif><a href="{{ url('/exams') }}">Exams</a></li> 
                        </ul>
                    </li>
                    @endif
                    @if((in_array(2,$roles)) || (in_array(3,$roles)))
                        <li @if($header == 'Accountabilities') class='active' @endif  >
                            <a href="#"><i class="fa fa-plus-square-o"></i> <span class="nav-label">Accountabilities</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li @if($subheader == 'Accountabilities') class='active' @endif><a href="{{ url('/accountabilites') }}">Accountabilities</a></li>
                                <li  @if($subheader == 'Billings') class='active' @endif><a href="{{ url('/billings') }}">Billings</a></li>
                                <li  @if($subheader == 'PDF') class='active' @endif><a href="{{ url('/billing-pdf') }}">PDF</a></li>
                            </ul>
                        </li>
                    @endif
                  
                    {{-- <li @if($header == 'Billings') class='active' @endif>
                        <a href="{{ url('/billings') }}" class='active' onclick='show()' ><i class="fa fa fa-money"></i> <span class="nav-label">Billings</span> </a>
                    </li> --}}
                    {{-- <li @if($header == 'Accountabilities') class='active' @endif>
                        <a href="{{ url('/accountabilites') }}" class='active' onclick='show()' ><i class="fa fa fa-money"></i> <span class="nav-label">Accountabilites</span> </a>
                    </li> --}}
                
                    {{-- <li @if($header == 'Contract') class='active' @endif>
                        <a href="{{ url('/contracts') }}" class='active' onclick='show()' ><i class="fa fa fa-money"></i> <span class="nav-label">Contracts</span> </a>
                    </li> --}}
                    {{-- <li @if($header == 'Employees') class='active' @endif  >
                        <a href="{{ url('/employees') }}"  onclick='show()'><i class="fa fa-group"></i> <span class="nav-label">Employees</span></a>
                    </li> --}}
                   
                    
                </ul>
                
            </div>
        </nav>
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i></a>
                        
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <span class="m-r-sm text-muted welcome-message">Welcome to HRIS.</span>
                        </li>
                        
                        {{-- <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                            </a>
                            <ul class="dropdown-menu dropdown-alerts">
                                <li>
                                    <a href="mailbox.html" class="dropdown-item">
                                        <div>
                                            <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                            <span class="float-right text-muted small">4 minutes ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <a href="profile.html" class="dropdown-item">
                                        <div>
                                            <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                            <span class="float-right text-muted small">12 minutes ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <a href="grid_options.html" class="dropdown-item">
                                        <div>
                                            <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                            <span class="float-right text-muted small">4 minutes ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <div class="text-center link-block">
                                        <a href="notifications.html" class="dropdown-item">
                                            <strong>See All Alerts</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li> --}}
                        
                        
                        <li>
                            <a href="{{ route('logout') }}"  onclick="logout(); show();">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>
                    
                </nav>
            </div>
            <form id="logout-form"  action="{{ route('logout') }}"  method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>{{$header}}</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">{{$header}}</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>{{$subheader}}</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">
                    
                </div>
            </div>
            
            @yield('content')
        </div>
        <script src="{{ asset('bootstrap/js/jquery-3.1.1.min.js') }}"></script>
        <script src="{{ asset('bootstrap/js/popper.min.js') }}"></script>
        <script src="{{ asset('bootstrap/js/bootstrap.js') }}"></script>
        <script src="{{ asset('bootstrap/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
        <script src="{{ asset('bootstrap/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
        
        <!-- Peity -->
        <script src="{{ asset('bootstrap/js/plugins/peity/jquery.peity.min.js') }}"></script>
        
        <!-- Custom and plugin javascript -->
        <script src="{{ asset('bootstrap/js/inspinia.js') }}"></script>
        
        <!-- iCheck -->
        <script src="{{ asset('bootstrap/js/plugins/iCheck/icheck.min.js') }}"></script>
        
        <script src="{{ asset('bootstrap/js/plugins/touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
        <!-- Peity -->
        <script src="{{ asset('bootstrap/js/demo/peity-demo.js') }}"></script>
        <!-- Chosen -->
        <script src="{{ asset('bootstrap/js/plugins/chosen/chosen.jquery.js') }}"></script>
        <!-- Flot -->
        <script src="{{ asset('bootstrap/js/plugins/flot/jquery.flot.js') }}"></script>
        <script src="{{ asset('bootstrap/js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
        <script src="{{ asset('bootstrap/js/plugins/flot/jquery.flot.spline.js') }}"></script>
        <script src="{{ asset('bootstrap/js/plugins/flot/jquery.flot.resize.js') }}"></script>
        <script src="{{ asset('bootstrap/js/plugins/flot/jquery.flot.pie.js') }}"></script>
        <script src="{{ asset('bootstrap/js/plugins/flot/jquery.flot.symbol.js') }}"></script>
        <script src="{{ asset('bootstrap/js/plugins/flot/jquery.flot.time.js') }}"></script>
        <link href="{{ asset('bootstrap/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" rel="stylesheet">
        <!-- Peity -->
        <script src="{{ asset('bootstrap/js/plugins/peity/jquery.peity.min.js') }}"></script>
        <!-- FooTable -->
        <script src="{{ asset('bootstrap/js/plugins/footable/footable.all.min.js') }}"></script>
        
        <!-- Custom and plugin javascript -->
        <script src="{{ asset('bootstrap/js/plugins/pace/pace.min.js') }}"></script>
        
        <!-- jQuery UI -->
        <script src="{{ asset('bootstrap/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        
        {{-- <!-- Jvectormap -->
            <script src="{{ asset('bootstrap/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
            <script src="{{ asset('bootstrap/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
            --}}
            <!-- Datatable -->
            <script src="{{ asset('bootstrap/js/plugins/dataTables/datatables.min.js') }}"></script>
            <script src="{{ asset('bootstrap/js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>
            <!-- EayPIE -->
            <script src="{{ asset('bootstrap/js/plugins/easypiechart/jquery.easypiechart.js') }}"></script>
            
            <!-- Sparkline -->
            <script src="{{ asset('bootstrap/js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
            
            <!-- Sparkline demo data  -->
            <script src="{{ asset('bootstrap/js/demo/sparkline-demo.js') }}"></script>
            
            <!-- Switchery -->
            <script src="{{ asset('bootstrap/js/plugins/switchery/switchery.js') }}"></script>
            <!-- Input Mask-->
            <script src="{{ asset('bootstrap/js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>
            <script src="{{ asset('bootstrap/js/plugins/summernote/summernote-bs4.js') }}"></script>
            
            <!-- blueimp gallery -->
            <script src="{{ asset('bootstrap/js/plugins/blueimp/jquery.blueimp-gallery.min.js') }}"></script>
            
            <!-- Jquery Validate -->
            <script src="{{ asset('bootstrap/js/plugins/validate/jquery.validate.min.js') }}"></script>
            <script>
                $(document).ready(function()
                {
                    
                    $("#form").validate({
                        rules: {
                            provider: {
                                required: true,
                                minlength: 3
                            },
                            
                        }
                    });
                    
                });
                
                $(document).ready(function() 
                {
                    
                    $('.footable').footable();
                    $('.footable2').footable();
                    
                });
                $(document).ready(function() {
                    // Setup - add a text input to each footer cell
                    
                } );
            </script>
            <script type='text/javascript'>
                function show()
                {
                    document.getElementById("myDiv").style.display="block";
                }
                function logout()
                {
                    event.preventDefault();
                    document.getElementById('logout-form').submit();
                }
                
                $(document).ready(function()
                {
                    
                    $('.dataTables-example').DataTable({
                        lengthMenu: [[10, 25, 50,-1], [10, 25, 50,"All"]],
                        // pageLength: -1,
                        scrollY:        true,
                        responsive: true,
                        searching: true,
                        ordering: false,
                        columnDefs: [
                        { width: 100, targets: 0 }
                        ],
                        dom: '<"html5buttons"B>lTfgitp',
                        buttons: [
                        // { extend: 'copy'},
                        {extend: 'csv'},
                        {extend: 'excel', title: 'ExampleFile'},
                        {extend: 'pdf', title: 'ExampleFile'},
                        
                        {
                            extend: 'print',
                            customize: function (win)
                            {
                                $(win.document.body).addClass('white-bg');
                                $(win.document.body).css('font-size', '10px');
                                
                                $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                            }
                        }]
                        
                    });
                    $('.dataTables-example1').DataTable({
                        lengthMenu: [[10, 25, 50,-1], [10, 25, 50,"All"]],
                        // pageLength: -1,
                        scrollY:        true,
                        responsive: true,
                        searching: true,
                        ordering: true,
                        // columnDefs: [
                        // { width: 100, targets: 0 }
                        // ],
                        dom: '<"html5buttons"B>lTfgitp',
                        buttons: [
                        // { extend: 'copy'},
                        {extend: 'csv'},
                        {extend: 'excel', title: 'ExampleFile'},
                        {extend: 'pdf', title: 'ExampleFile'},
                        
                        {
                            extend: 'print',
                            customize: function (win)
                            {
                                $(win.document.body).addClass('white-bg');
                                $(win.document.body).css('font-size', '10px');
                                
                                $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                            }
                        }]
                        
                    });
                    
                    $('#manpower-datatable').DataTable({
                        paging: false,
                        responsive: true,
                        searching: true,
                        dom: '<"html5buttons"B>lTfgitp',
                        buttons: [],
                        
                    });
                    $('#manpower-datatable-1').DataTable({
                        paging: false,
                        responsive: true,
                        searching: true,
                        sorting: false,
                        dom: '<"html5buttons"B>lTfgitp',
                        buttons: [],
                        
                    });
                    $('#billing_report').DataTable({
                        paging: true,
                        responsive: true,
                        searching: true,
                        pageLength: 10,
                        scrollX: true,
                        responsive: true,
                        searching: true,
                        dom: '<"html5buttons"B>lTfgitp',
                        buttons: [
                        // { extend: 'copy'},
                        {extend: 'csv'},
                        {extend: 'excel', title: 'billing_report'},
                        {extend: 'pdf', title: 'billing_report'},
                        
                        {extend: 'print',
                        customize: function (win)
                        {
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');
                            
                            $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                        }
                    }],
                    
                    fixedColumns:   {
                        leftColumns: 1,
                        rightColumns: 1
                    },
                    
                });
                $('#manpower-datatable-for-approval').DataTable({
                    paging: false,
                    responsive: true,
                    searching: true,
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: [],
                    
                });
                $('#manpower-datatable-approved-manpower').DataTable({
                    paging: false,
                    responsive: true,
                    searching: true,
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: [],
                    
                });
            });
            $('.custom-file-input').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
            }); 
            $('.chosen-select').chosen({width: "100%"});
            
            $(".touchspin1").TouchSpin({
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white',
                min: 1,
            });
            $(".touchspin2").TouchSpin({
                min: 6,
                max: 100,
                maxboostedstep: 10,
                postfix: 'Months',
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });
            
            function imgError(image) 
            {
                image.onerror = "";
                image.src = "{{URL::asset('/images/no_image.png')}}";
                return true;
            }
            function viewActiveEmployee()
            {
                
                if($('#tab-1-data').children().length == 0)
                {
                    $('#tab-1-data').children().remove();
                    
                    document.getElementById("Loading").style.display="block";
                    $.ajax({ 
                        
                        type: "GET",
                        url: "{{ url('/get-active-employees') }}",          
                        dataType: "json",   //expect html to be returned
                        success: function(data)
                        { 
                            $('#tab-1-data').append('<div class="col-lg-12"><div class="md-form mt-1 mb-2 col-lg-3"><input class="form-control" id="Search" onkeyup="searchName()"  type="text" placeholder="Search" aria-label="Search"></div></div>');
                            
                            jQuery.each(data, function(key) {
                                var name = data[key].employee_user.email;
                                var dataimage = '<div class="col-lg-2 target"><div class="contact-box center-version"><a href="#">';
                                    dataimage += '<img alt="image" class="rounded-circle" src="http://10.96.4.40:8441/hrportal/public/id_image/employee_image/'+ data[key].id +'.png"  onerror="imgError(this);" >';
                                    dataimage += ' <h5 class="m-b-xs"><strong>'+ data[key].first_name +' ' + data[key].last_name +'</strong></h5>';
                                    dataimage += ' <div class="font-bold"><h6>'+ data[key].position +'</h6></div>';
                                    dataimage += ' <address class="m-t-md">';
                                        dataimage += '<strong>'+data[key].employee_company[0].name+'</strong><br>';
                                        dataimage += ' <abbr title="Email"><i class="fa fa-envelope"></i></abbr> <span title='+data[key].employee_user.email+'>'+ name.substring(0,25);
                                            dataimage += '  </span></address>';
                                            
                                            dataimage += '</a></div></div>';
                                            
                                            $('#tab-1-data').append(dataimage);
                                        });
                                        document.getElementById("Loading").style.display="none";
                                    },
                                    error: function(e)
                                    {
                                        alert(e);
                                    }
                                });
                            }
                        }
                        function viewInactiveEmployee()
                        {
                            if($('#tab-2-data').children().length == 0)
                            {
                                $('#tab-2-data').children().remove();
                                
                                document.getElementById("Loading").style.display="block";
                                $.ajax({ 
                                    
                                    type: "GET",
                                    url: "{{ url('/get-inactive-employees') }}",          
                                    dataType: "json",   //expect html to be returned
                                    success: function(data)
                                    { 
                                        $('#tab-2-data').append('<div class="col-lg-12"><div class="md-form mt-1 mb-2 col-lg-3"><input class="form-control" id="SearchInactive" onkeyup="searchNameinActive()"  type="text" placeholder="Search" aria-label="Search"></div></div>');
                                        
                                        jQuery.each(data, function(key) {
                                            var name = data[key].employee_user.email;
                                            var dataimage = '<div class="col-lg-2 targetInactive"><div class="contact-box center-version"><a href="#">';
                                                dataimage += '<img alt="image" class="rounded-circle" src="http://10.96.4.40:8441/hrportal/public/id_image/employee_image/'+ data[key].id +'.png" onerror="imgError(this);" >';
                                                dataimage += ' <h5 class="m-b-xs"><strong>'+ data[key].first_name +' ' + data[key].last_name +'</strong></h5>';
                                                dataimage += ' <div class="font-bold"><h6>'+ data[key].position +'</h6></div>';
                                                dataimage += ' <address class="m-t-md">';
                                                    dataimage += '<strong>'+data[key].employee_company[0].name+'</strong><br>';
                                                    dataimage += ' <abbr title="Email"><i class="fa fa-envelope"></i></abbr> <span title='+data[key].employee_user.email+'>'+ name.substring(0,25);
                                                        dataimage += '  </span></address>';
                                                        
                                                        dataimage += '</a></div></div>';
                                                        
                                                        $('#tab-2-data').append(dataimage);
                                                    });
                                                    document.getElementById("Loading").style.display="none";
                                                },
                                                error: function(e)
                                                {
                                                    alert(e);
                                                }
                                            });
                                        }
                                        
                                    }
                                    
                                    function viewRegularActive()
                                    {
                                        if($('#tab-4-data').children().length == 0)
                                        {
                                            $('#tab-4-data').children().remove();
                                            
                                            document.getElementById("Loading").style.display="block";
                                            $.ajax({ 
                                                
                                                type: "GET",
                                                url: "{{ url('/get-regular-employees') }}",          
                                                dataType: "json",   //expect html to be returned
                                                success: function(data)
                                                { 
                                                    $('#tab-4-data').append('<div class="col-lg-12"><div class="md-form mt-1 mb-2 col-lg-3"><input class="form-control" id="SearchRegularActive" onkeyup="sRegularActive()"  type="text" placeholder="Search" aria-label="Search"></div></div>');
                                                    
                                                    jQuery.each(data, function(key) {
                                                        var name = data[key].employee_user.email;
                                                        var dataimage = '<div class="col-lg-2 targetRegularActive"><div class="contact-box center-version"><a href="#">';
                                                            dataimage += '<img alt="image" class="rounded-circle" src="http://10.96.4.40:8441/hrportal/public/id_image/employee_image/'+ data[key].id +'.png" onerror="imgError(this);">';
                                                            dataimage += ' <h5 class="m-b-xs"><strong>'+ data[key].first_name +' ' + data[key].last_name +'</strong></h5>';
                                                            dataimage += ' <div class="font-bold"><h6>'+ data[key].position +'</h6></div>';
                                                            dataimage += ' <address class="m-t-md">';
                                                                dataimage += '<strong>'+data[key].employee_company[0].name+'</strong><br>';
                                                                dataimage += ' <abbr title="Email"><i class="fa fa-envelope"></i></abbr> <span title='+data[key].employee_user.email+'>'+ name.substring(0,25);
                                                                    dataimage += '  </span></address>';
                                                                    
                                                                    dataimage += '</a></div></div>';
                                                                    
                                                                    $('#tab-4-data').append(dataimage);
                                                                });
                                                                document.getElementById("Loading").style.display="none";
                                                            },
                                                            error: function(e)
                                                            {
                                                                alert(e);
                                                            }
                                                        });
                                                    }
                                                    
                                                }
                                                function formatDate(date) 
                                                {
                                                    var d = new Date(date),
                                                    month = '' + (d.getMonth() + 1),
                                                    day = '' + d.getDate(),
                                                    year = d.getFullYear();
                                                    
                                                    if (month.length < 2) 
                                                    month = '0' + month;
                                                    if (day.length < 2) 
                                                    day = '0' + day;
                                                    
                                                    return [year, month, day].join('-');
                                                }
                                                function viewProbationaryActive()
                                                {
                                                    if($('#tab-3-data').children().length == 0)
                                                    {
                                                        $('#tab-3-data').children().remove();
                                                        
                                                        document.getElementById("Loading").style.display="block";
                                                        $.ajax({ 
                                                            
                                                            type: "GET",
                                                            url: "{{ url('/get-probationary-active-employees') }}",          
                                                            dataType: "json",   //expect html to be returned
                                                            success: function(data)
                                                            { 
                                                                $('#tab-3-data').append('<div class="col-lg-12"><div class="md-form mt-1 mb-2 col-lg-3"><input class="form-control" id="searchProbiActive" onkeyup="searchProbationaryActive()"  type="text" placeholder="Search" aria-label="Search"></div></div>');
                                                                
                                                                jQuery.each(data, function(key) {
                                                                    var name = data[key].employee_user.email;
                                                                    var dataimage = '<div class="col-lg-2 targetProbationaryActive"><div class="contact-box center-version"><a href="#">';
                                                                        dataimage += '<img alt="image" class="rounded-circle" src="http://10.96.4.40:8441/hrportal/public/id_image/employee_image/'+ data[key].id +'.png" onerror="imgError(this);">';
                                                                        dataimage += ' <h5 class="m-b-xs"><strong>'+ data[key].first_name +' ' + data[key].last_name +'</strong></h5>';
                                                                        dataimage += ' <div class="font-bold"><h6>'+ data[key].position +'</h6></div>';
                                                                        dataimage += ' <address class="m-t-md">';
                                                                            dataimage += '<strong>'+data[key].employee_company[0].name+'</strong><br>';
                                                                            dataimage += ' <abbr title="Email"><i class="fa fa-envelope"></i></abbr> <span title='+data[key].employee_user.email+'>'+ name.substring(0,25);
                                                                                dataimage += '  </span></address><br>';
                                                                                dataimage += '<h6>Date hired: '+formatDate(data[key].date_hired)+'</h6>';
                                                                                dataimage += '</a></div></div>';
                                                                                
                                                                                $('#tab-3-data').append(dataimage);
                                                                            });
                                                                            document.getElementById("Loading").style.display="none";
                                                                        },
                                                                        error: function(e)
                                                                        {
                                                                            alert(e);
                                                                        }
                                                                    });
                                                                }
                                                                
                                                            }
                                                            function viewInactiveEmployee()
                                                            {
                                                                if($('#tab-2-data').children().length == 0)
                                                                {
                                                                    $('#tab-2-data').children().remove();
                                                                    
                                                                    document.getElementById("Loading").style.display="block";
                                                                    $.ajax({ 
                                                                        
                                                                        type: "GET",
                                                                        url: "{{ url('/get-inactive-employees') }}",          
                                                                        dataType: "json",   //expect html to be returned
                                                                        success: function(data)
                                                                        { 
                                                                            $('#tab-2-data').append('<div class="col-lg-12"><div class="md-form mt-1 mb-2 col-lg-3"><input class="form-control" id="SearchInactive" onkeyup="searchNameinActive()"  type="text" placeholder="Search" aria-label="Search"></div></div>');
                                                                            
                                                                            jQuery.each(data, function(key) {
                                                                                var name = data[key].employee_user.email;
                                                                                var dataimage = '<div class="col-lg-2 targetInactive"><div class="contact-box center-version"><a href="#">';
                                                                                    dataimage += '<img alt="image" class="rounded-circle" src="http://10.96.4.40:8441/hrportal/public/id_image/employee_image/'+ data[key].id +'.png"  onerror="imgError(this);">';
                                                                                    dataimage += ' <h5 class="m-b-xs"><strong>'+ data[key].first_name +' ' + data[key].last_name +'</strong></h5>';
                                                                                    dataimage += ' <div class="font-bold"><h6>'+ data[key].position +'</h6></div>';
                                                                                    dataimage += ' <address class="m-t-md">';
                                                                                        dataimage += '<strong>'+data[key].employee_company[0].name+'</strong><br>';
                                                                                        dataimage += ' <abbr title="Email"><i class="fa fa-envelope"></i></abbr> <span title='+data[key].employee_user.email+'>'+ name.substring(0,25);
                                                                                            dataimage += '  </span></address>';
                                                                                            
                                                                                            dataimage += '</a></div></div>';
                                                                                            
                                                                                            $('#tab-2-data').append(dataimage);
                                                                                        });
                                                                                        document.getElementById("Loading").style.display="none";
                                                                                    },
                                                                                    error: function(e)
                                                                                    {
                                                                                        alert(e);
                                                                                    }
                                                                                });
                                                                            }
                                                                            
                                                                        }
                                                                        function viewProjectActive()
                                                                        {
                                                                            if($('#tab-5-data').children().length == 0)
                                                                            {
                                                                                $('#tab-5-data').children().remove();
                                                                                
                                                                                document.getElementById("Loading").style.display="block";
                                                                                $.ajax({ 
                                                                                    
                                                                                    type: "GET",
                                                                                    url: "{{ url('/get-project-employees') }}",          
                                                                                    dataType: "json",   //expect html to be returned
                                                                                    success: function(data)
                                                                                    { 
                                                                                        
                                                                                        jQuery.each(data, function(key) {
                                                                                            var name = data[key].employee_user.email;
                                                                                            var dataimage = '<div class="col-lg-2"><div class="contact-box center-version"><a href="#">';
                                                                                                dataimage += '<img alt="image" class="rounded-circle" src="http://10.96.4.40:8441/hrportal/public/id_image/employee_image/'+ data[key].id +'.png"  onerror="imgError(this);">';
                                                                                                dataimage += ' <h5 class="m-b-xs"><strong>'+ data[key].first_name +' ' + data[key].last_name +'</strong></h5>';
                                                                                                dataimage += ' <div class="font-bold"><h6>'+ data[key].position +'</h6></div>';
                                                                                                dataimage += ' <address class="m-t-md">';
                                                                                                    dataimage += '<strong>'+data[key].employee_company[0].name+'</strong><br>';
                                                                                                    dataimage += ' <abbr title="Email"><i class="fa fa-envelope"></i></abbr> <span title='+data[key].employee_user.email+'>'+ name.substring(0,25);
                                                                                                        dataimage += '  </span></address>';
                                                                                                        
                                                                                                        dataimage += '</a></div></div>';
                                                                                                        
                                                                                                        $('#tab-5-data').append(dataimage);
                                                                                                    });
                                                                                                    document.getElementById("Loading").style.display="none";
                                                                                                },
                                                                                                error: function(e)
                                                                                                {
                                                                                                    alert(e);
                                                                                                }
                                                                                            });
                                                                                        }
                                                                                        
                                                                                    }
                                                                                    function viewConsultantActive()
                                                                                    {
                                                                                        if($('#tab-6-data').children().length == 0)
                                                                                        {
                                                                                            $('#tab-6-data').children().remove();
                                                                                            
                                                                                            document.getElementById("Loading").style.display="block";
                                                                                            $.ajax({ 
                                                                                                
                                                                                                type: "GET",
                                                                                                url: "{{ url('/get-consultant-employees') }}",          
                                                                                                dataType: "json",   //expect html to be returned
                                                                                                success: function(data)
                                                                                                { 
                                                                                                    
                                                                                                    jQuery.each(data, function(key) {
                                                                                                        var name = data[key].employee_user.email;
                                                                                                        var dataimage = '<div class="col-lg-2"><div class="contact-box center-version"><a href="#">';
                                                                                                            dataimage += '<img alt="image" class="rounded-circle" src="http://10.96.4.40:8441/hrportal/public/id_image/employee_image/'+ data[key].id +'.png"  onerror="imgError(this);">';
                                                                                                            dataimage += ' <h5 class="m-b-xs"><strong>'+ data[key].first_name +' ' + data[key].last_name +'</strong></h5>';
                                                                                                            dataimage += ' <div class="font-bold"><h6>'+ data[key].position +'</h6></div>';
                                                                                                            dataimage += ' <address class="m-t-md">';
                                                                                                                dataimage += '<strong>'+data[key].employee_company[0].name+'</strong><br>';
                                                                                                                dataimage += ' <abbr title="Email"><i class="fa fa-envelope"></i></abbr> <span title='+data[key].employee_user.email+'>'+ name.substring(0,25);
                                                                                                                    dataimage += '  </span></address>';
                                                                                                                    
                                                                                                                    dataimage += '</a></div></div>';
                                                                                                                    
                                                                                                                    $('#tab-6-data').append(dataimage);
                                                                                                                });
                                                                                                                document.getElementById("Loading").style.display="none";
                                                                                                            },
                                                                                                            error: function(e)
                                                                                                            {
                                                                                                                alert(e);
                                                                                                            }
                                                                                                        });
                                                                                                    }
                                                                                                    
                                                                                                }
                                                                                                function searchName()
                                                                                                {
                                                                                                    var input = document.getElementById("Search");
                                                                                                    var filter = input.value.toLowerCase();
                                                                                                    var nodes = document.getElementsByClassName('target');
                                                                                                    for (i = 0; i < nodes.length; i++) {
                                                                                                        if (nodes[i].innerText.toLowerCase().includes(filter)) {
                                                                                                            nodes[i].style.display = "";
                                                                                                        } else {
                                                                                                            nodes[i].style.display = "none";
                                                                                                        }
                                                                                                    }
                                                                                                }
                                                                                                function searchNameinActive()
                                                                                                {
                                                                                                    var input = document.getElementById("SearchInactive");
                                                                                                    var filter = input.value.toLowerCase();
                                                                                                    var nodes = document.getElementsByClassName('targetInactive');
                                                                                                    for (i = 0; i < nodes.length; i++) {
                                                                                                        if (nodes[i].innerText.toLowerCase().includes(filter)) {
                                                                                                            nodes[i].style.display = "";
                                                                                                        } else {
                                                                                                            nodes[i].style.display = "none";
                                                                                                        }
                                                                                                    }
                                                                                                }
                                                                                                function searchProbationaryActive()
                                                                                                {
                                                                                                    var input = document.getElementById("searchProbiActive");
                                                                                                    var filter = input.value.toLowerCase();
                                                                                                    var nodes = document.getElementsByClassName('targetProbationaryActive');
                                                                                                    for (i = 0; i < nodes.length; i++) {
                                                                                                        if (nodes[i].innerText.toLowerCase().includes(filter)) {
                                                                                                            nodes[i].style.display = "";
                                                                                                        } else {
                                                                                                            nodes[i].style.display = "none";
                                                                                                        }
                                                                                                    }
                                                                                                }
                                                                                                function sRegularActive()
                                                                                                {
                                                                                                    var input = document.getElementById("SearchRegularActive");
                                                                                                    var filter = input.value.toLowerCase();
                                                                                                    var nodes = document.getElementsByClassName('targetRegularActive');
                                                                                                    for (i = 0; i < nodes.length; i++) {
                                                                                                        if (nodes[i].innerText.toLowerCase().includes(filter)) {
                                                                                                            nodes[i].style.display = "";
                                                                                                        } else {
                                                                                                            nodes[i].style.display = "none";
                                                                                                        }
                                                                                                    }
                                                                                                }
                                                                                            </script>
                                                                                            @if($header == "Employees")
                                                                                            <script type='text/javascript'>
                                                                                                $(document).ready(function(){
                                                                                                    viewActiveEmployee();
                                                                                                });
                                                                                            </script>
                                                                                            @endif
                                                                                        </body>
                                                                                        </html>
                                                                                        