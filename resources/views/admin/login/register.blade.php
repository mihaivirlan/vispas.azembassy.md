@extends('admin.adminLayout')

@section('content')
    <h1 class="page-header">
        {{ trans('register.register') }}
    </h1>
    <div class="col-xs-12 col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">{{ trans('register.register') }}</div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ URL::route('admin/register') }}">
                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label class="col-md-4 control-label">{{ trans('trans.name') }}</label>

                        <div class="col-md-6">
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">{{ trans('trans.email') }}</label>

                        <div class="col-md-6">
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">{{ trans('trans.phone') }}</label>

                        <div class="col-md-6">
                            <input type="text"  name="phone" class="form-control phone" value="{{ old('phone') }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">{{ trans('l.password') }}</label>

                        <div class="col-md-6">
                            <input type="password" name="password" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">{{ trans('l.password_repeat') }}</label>

                        <div class="col-md-6">
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">{{ trans('register.register') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop