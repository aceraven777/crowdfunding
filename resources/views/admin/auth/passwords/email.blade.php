@extends('admin.layouts.auth')

@section('content')

<p class="login-box-msg">Reset Password</p>

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<form action="{{ url('/backend/password/email') }}" method="post">
    {!! csrf_field() !!}

    <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
    <div class="row">
        <div class="col-xs-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Send Password Reset Link</button>
        </div>
        <!-- /.col -->
    </div>
</form>

<a href="{{ url('/backend/register') }}">Register a new membership</a>

@endsection
