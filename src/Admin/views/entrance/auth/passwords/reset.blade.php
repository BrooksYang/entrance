@extends('entrance::layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <!-- Cotainer -->
                <div class="paper-wrap bevel tlbr">

                    {{-- App Name --}}
                    <div id="paper-top">
                        <div class="row">
                            <div class="col-lg-12 no-pad">
                                <a class="navbar-brand logo-text" href="#">{{ config('app.name', 'Laravel') }}</a>
                            </div>
                        </div>
                    </div>

                    <!-- CONTENT -->
                    <div style="min-height:400px;" class="wrap-fluid" id="paper-bg">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="account-box">
                                    @if (session('status'))
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    {{-- Login Form --}}
                                    <form role="form" method="POST" action="{{ route('password.request') }}">
                                        {{ csrf_field() }}

                                        {{-- Token --}}
                                        <input type="hidden" name="token" value="{{ $token }}">

                                        {{-- Email --}}
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label>邮箱</label>
                                            <input id="email" type="email" class="form-control" name="email"
                                                   value="{{ old('email') }}" required autofocus>
                                            @if ($errors->has('email'))
                                                <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                                            @endif
                                        </div>

                                        {{-- Password --}}
                                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                            <label>密码</label>
                                            <input id="password" type="password" class="form-control" name="password"
                                                   required>
                                            @if ($errors->has('password'))
                                                <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                                            @endif
                                        </div>

                                        {{-- Password Confirmation --}}
                                        <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                            <label>密码</label>
                                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation"
                                                   required>
                                            @if ($errors->has('password_confirmation'))
                                                <span class="help-block"><strong>{{ $errors->first('password_confirmation') }}</strong></span>
                                            @endif
                                        </div>

                                        {{-- Login --}}
                                        <button class="btn btn btn-primary pull-right" type="submit">登录</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
