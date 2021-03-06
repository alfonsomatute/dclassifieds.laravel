@extends('layout.index_layout')

@section('title', join(' / ', $title))

@section('search_filter')
    <div style="margin-bottom: 20px;"></div>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> {{ trans('reset.Home') }}</a></li>
                    <li class="active">{{ trans('reset.Reset Password') }}</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="row">
                    <div class="col-md-offset-2 col-md-10">
                        <h2>{{ trans('reset.Reset Password') }}</h2>
                    </div>
                </div>

                <form class="form-horizontal" method="POST" action="{{ url('reset') }}">

                    {!! csrf_field() !!}
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group required {{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-2 control-label">{{ trans('reset.E-Mail') }}</label>
                        <div class="col-md-5">
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group required {{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-2 control-label">{{ trans('reset.Password') }}</label>
                        <div class="col-md-5">
                            <input type="password" class="form-control" name="password" id="password" >
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group required {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label for="password_confirmation" class="col-md-2 control-label">{{ trans('reset.Confirm Password') }}</label>
                        <div class="col-md-5">
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" >
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember"> {{ trans('reset.Remember me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10 margin_bottom_15">
                            <button type="submit" class="btn btn-primary">{{ trans('reset.Reset Password') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
