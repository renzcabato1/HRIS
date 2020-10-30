@extends('layouts.app')

@section('content')
<div class="middle-box text-center loginscreen animated fadeInDown mt-5">
    <div>
        <div class="m-b-md mt-5">
            <img alt="image" class="rounded-circle" src="{{asset('images/front-logo.png')}}" style='width:135px;'>
        </div>
        <h3>Human Resource Information System</h3>
        
        
        <form method="POST" action="{{ route('password.request') }}" aria-label="{{ __('Reset Password') }}" onsubmit='show()'>
            @csrf
            <div class="form-group">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" placeholder="E-mail Address" required autofocus>
            </div>
            <div class="form-group">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="New Password" name="password" required>
                
            </div>
            <div class="form-group">
                
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm password" required>
                
            </div>
            @if (session('status'))
            <div class="form-group alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <strong>{{ session('status') }}</strong>
                </div>
            @endif
            @if ($errors->has('password'))
            <div class="form-group alert alert-danger alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <strong>  {{ $errors->first('password') }}</strong>
                </div>
            @endif
            @if ($errors->has('email'))
            <div class="form-group alert alert-danger alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <strong>{{ $errors->first('email') }}</strong>
            </div>
            @endif
            
            <button type="submit" class="btn btn-primary block full-width m-b">Reset Password</button>
        </form>
        {{-- <p class="m-t"> <small>Copyright &copy; {{date('Y')}}</small> </p> --}}
    </div>
</div>

@endsection
