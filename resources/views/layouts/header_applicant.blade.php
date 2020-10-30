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
    
    <link href="{{ asset('bootstrap/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    
    
    <link href="{{ asset('bootstrap/css/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/plugins/switchery/switchery.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/plugins/steps/jquery.steps.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/plugins/chosen/bootstrap-chosen.css') }}" rel="stylesheet">
    <style>
        html,body{
            height:100%;
        }
        .carousel,.item,.active{
            width: 100%; 
        }
        .carousel,.item{
            height: 100%;
        }
        .carousel-inner{
            height:100%;
        }
        .carousel-inner img {
            width: 100%;
            height:100%;
        }
        .carousel 
        {
            height:100%;
        }
        #test {
            /* border:1px; */
            margin: 0 auto;
            /* background-color:white; */
            text-align: center;
            position:absolute;
            z-index:40;
            top:65%;
            left:40%;
        
        }
        .btn-xlarge {
            padding: 18px 28px;
            font-size: 22px; /*change this to your desired size*/
            /* line-height: normal; */
            -webkit-border-radius: 8px;
            -moz-border-radius: 8px;
            border-radius: 8px;
            width: 300px;
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
        .wizard-big.wizard > .content
        {
            min-height:500px;
        }
        .wizard > .content
        {
           overflow-y: auto;
        }
        
    </style>
</head>
<body >
    <div id = "myDiv" style="display:none;" class="loader">
    </div>
    @yield('content')
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
    
    <!-- Custom and plugin javascript -->
    <script src="{{ asset('bootstrap/js/plugins/pace/pace.min.js') }}"></script>
    
    <!-- jQuery UI -->
    <script src="{{ asset('bootstrap/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    
    <!-- Jvectormap -->
    <script src="{{ asset('bootstrap/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    
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
     <!-- Steps -->
     <script src="{{ asset('bootstrap/js/plugins/steps/jquery.steps.min.js') }}"></script>
     <script src="{{ asset('bootstrap/js/plugins/validate/jquery.validate.min.js') }}"></script>
         <!-- Chosen -->
    <script src="{{ asset('bootstrap/js/plugins/chosen/chosen.jquery.js') }}"></script>

    {{-- <script src="{{ asset('bootstrap/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script> --}}
    
     <script>
        $(document).ready(function(){
            
            $("#wizard").steps();
            $("#form").steps({
                bodyTag: "fieldset",
                onStepChanging: function (event, currentIndex, newIndex)
                {
                    // Always allow going backward even if the current step contains invalid fields!
                    if (currentIndex > newIndex)
                    {
                        return true;
                    }

                    // Forbid suppressing "Warning" step if the user is to young
                    if (newIndex === 3 && Number($("#age").val()) < 18)
                    {
                        return false;
                    }

                    var form = $(this);

                    // Clean up if user went backward before
                    if (currentIndex < newIndex)
                    {
                        // To remove error styles
                        $(".body:eq(" + newIndex + ") label.error", form).remove();
                        $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                    }

                    // Disable validation on fields that are disabled or hidden.
                    form.validate().settings.ignore = ":disabled,:hidden";

                    // Start validation; Prevent going forward if false
                    return form.valid();
                },
                onStepChanged: function (event, currentIndex, priorIndex)
                {
                    // Suppress (skip) "Warning" step if the user is old enough.
                    if (currentIndex === 2 && Number($("#age").val()) >= 18)
                    {
                        $(this).steps("next");
                    }

                    // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
                    if (currentIndex === 2 && priorIndex === 3)
                    {
                        $(this).steps("previous");
                    }
                },
                onFinishing: function (event, currentIndex)
                {
                    var form = $(this);

                    // Disable validation on fields that are disabled.
                    // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                    form.validate().settings.ignore = ":disabled";

                    // Start validation; Prevent form submission if false
                    return form.valid();
                },
                onFinished: function (event, currentIndex)
                {
                    var form = $(this);

                    // Submit form input
                    form.submit();
                }
            }).validate({
                        errorPlacement: function (error, element)
                        {
                            element.before(error);
                        },
                        rules: {
                            confirm: {
                                equalTo: "#password"
                            }
                        }
                    });
       });
    </script>
    <script>
        $('.carousel').carousel({
            interval: 1500
        })
        function show()
        {
            document.getElementById("myDiv").style.display="block";
        }
        $('.chosen-select').chosen({width: "100%"});
        
    </script>

</body>
</html>
