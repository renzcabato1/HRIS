@extends('layouts.app')

@section('content')
<div class="middle-box text-center loginscreen animated fadeInDown mt-5">
    <div>
        <div class="m-b-md mt-5">
            <img alt="image" class="rounded-circle" src="{{asset('images/front-logo.png')}}" style='width:135px;'>
        </div>
        <h3>Human Resource Information System</h3>
        
        
        <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}" onsubmit='show()'>
            @csrf
            <div class="form-group">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder='Email' name="email" value="{{ old('email') }}" required>
            </div>
            @if ($errors->has('email'))
            
            <div class="form-group alert alert-danger alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <strong>{{ $errors->first('email') }}</strong>
            </div>
            @endif
            @if (session('status'))
            <div class="form-group alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <strong>{{ session('status') }}</strong>
                </div>
            @endif
            <button type="submit" class="btn btn-primary block full-width m-b">Send Reset Password</button>
            
            <a href="{{ route('login') }}" onclick='show()'><small><i class="fa fa-caret-square-o-left"></i>back to login page</small></a>
        </form>
        {{-- <p class="m-t"> <small>Copyright &copy; {{date('Y')}}</small> </p> --}}
    </div>
</div>

@endsection
