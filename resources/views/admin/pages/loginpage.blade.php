@extends('admin.layout.loginapp')
@section('content')
<div class="row">
    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">Log in</div>
            <div class="panel-body">
                <form role="form" method="post"  action="{{ route('/') }}" id="loginform">{{ csrf_field() }}
                    <fieldset>
                        <div class="form-group">
                            <label>Select</label>
                            <select class="form-control" autofocus="" name='selection' id='selection'>
                                <option value=''>Select Your Batch</option>
                                <option value="1">Administrator</option>
                                <option value="2">University</option>
                                <option value="3">Company</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="E-mail" name="email" type="email">
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Password" name="password" type="password" value="">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input name="remember" type="checkbox" value="Remember Me">Remember Me
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button></fieldset>
                        </br>
                        <div class="form-group">
                            <a href="{{ route('forgotpassword') }}" >Forgot password?</a>
                        </div>
                </form>
            </div>
        </div>
    </div><!-- /.col-->
</div><!-- /.row -->	
@endsection
