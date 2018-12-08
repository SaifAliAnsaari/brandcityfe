@extends('layouts.master')

@section('content')

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
@if (session('warning'))
    <div class="alert alert-warning">
        {{ session('warning') }}
    </div>
@endif

<section class="main-container col1-layout">
    <div class="main container">
        <div class="account-login">
            <div class="page-title">
                <h2>Login or Create an Account</h2>
            </div>
            <fieldset class="col2-set">
                <div class="col-1 new-users"><strong>New Customers</strong>
                    <div class="content">
                        <p>By creating an account with our store, you will be able to move through the checkout process
                            faster, store multiple shipping addresses, view and track your orders in your account and
                            more.</p>
                        <div class="buttons-set">
                            <button onclick="window.location='/register';" class="button create-account" type="button"><span>Create
                                    an Account</span></button>
                        </div>
                    </div>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="col-2 registered-users"><strong>Registered Customers</strong>
                        <div class="content">
                            <p>If you have an account with us, please log in.</p>
                            <ul class="form-list">
                                <li>
                                    <input id="email" type="email" class="input-text form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </li>
                                <li>
                                    <input id="password" type="password" class="input-text form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        name="password" required>

                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </li>
                                <li>
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </li>
                            </ul>
                            <div class="buttons-set">
                                <button type="submit" class="login  button">
                                    {{ __('Login') }}
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </fieldset>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>
</section>
@endsection
