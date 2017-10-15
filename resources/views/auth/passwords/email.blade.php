@extends('layouts.user.master', [
	'title' => 'Reset Password | Dragaud Custom Sojourns',
])

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2 ">
            <div class="panel panel-default border-panel floating-div">
                <div class="panel-heading pwreset-heading">Reset Password</div>

                <div class="panel-body pwreset-body">
                    <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $_GET['token'] }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-3 control-label">E-Mail Address</label>

                            <div class="col-md-7">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $_GET['email']  }}" required readonly>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-3 control-label">New Password</label>

                            <div class="col-md-7">
                                <input id="password" type="password" class="form-control pass-bullets" name="password" required autofocus>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-3 control-label">Confirm Password</label>
                            <div class="col-md-7">
                                <input id="password-confirm" type="password" class="form-control pass-bullets" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
															<button type="submit" class="col-md-12 waves-effect waves-light ds-button button-gen" style="width: 100%;">
                                    Save Changes
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
		<script>$(".login-container").hide()</script>
@endsection
