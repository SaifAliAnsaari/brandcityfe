@extends('layouts.master')

@section('content')
<section class="main-container col1-layout">
    <div class="main container">
        <div class="account-login">
            <div class="page-title">
                <h2>Reset Password</h2>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4" style="text-align:center;">

                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="content">
                        <ul class="form-list">

                            <li>
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail
                                    Address') }}</label>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </li>
                        </ul>
                        <div class="buttons-set" style="margin-top:10px;">
                            <button type="submit" class="login button">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>
</section>

@endsection
