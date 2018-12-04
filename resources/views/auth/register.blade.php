@extends('layouts.master')

@section('content')


<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
<section class="main-container col1-layout">
    <div class="main container">
        <div class="account-login">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="page-title">
                    <h2>Create an Account</h2>
                </div>
                <fieldset class="col2-set">
                    <div class="col-1 new-users"> <strong>Personal Information</strong>
                        <div class="content">
                            <input type="hidden" name="success_url">
                            <input type="hidden" name="error_url">
                            <ul class="form-list">
                                <li class="fields">
                                    <div class="customer-name">
                                        <div class="input-box name-firstname">
                                            <label for="firstname">First Name<span class="required">*</span></label>
                                            <div class="input-box1">
                                                <input id="first_name" type="text" class="input-text form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                                                    name="first_name" value="{{ old('first_name') }}" required
                                                    autofocus>

                                                @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="input-box name-lastname">
                                            <label for="lastname">Last Name<span class="required">*</span></label>
                                            <div class="input-box1">
                                                <input id="last_name" type="text" class="input-text form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                                                    name="last_name" value="{{ old('last_name') }}" required autofocus>

                                                @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->last('name') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <label for="email_address">Email Address<em class="required">*</em></label>
                                    <div class="input-box">
                                        <input id="email" type="email" class="input-text form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            name="email" value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </li>
                                <li class="control">
                                    <input type="checkbox" name="is_subscribed" title="Sign Up for Newsletter" value="1"
                                        id="is_subscribed" class="checkbox">
                                    <label for="is_subscribed">Sign Up for Newsletter</label>
                                </li>
                            </ul>
                        </div>
                        <!--content-->
                    </div>
                    <div class="col-2 registered-users"> <strong>Login Information</strong>
                        <div class="content">
                            <ul class="form-list">
                                <li class="fields">
                                    <div class="field">
                                        <label for="password">Password<em class="required">*</em></label>
                                        <div class="input-box">
                                            <input id="password" type="password" class="input-text form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                name="password" required>

                                            @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label for="confirmation">Confirm Password<em class="required">*</em></label>
                                        <div class="input-box">
                                            <input id="password-confirm" type="password" class="input-text form-control"
                                                name="password_confirmation" required>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!--content-->

                        <div class="buttons-set">
                            <p class="required" style="text-align:right;">* Required Fields</p>
                            <button type="submit" class="button submit">
                                {{ __('Register') }}
                            </button>
                            <a href="#"><small>« </small>Back</a>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>
</section>

@endsection
