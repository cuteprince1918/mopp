@extends('admin.layout.loginapp')
@section('content')
<div class="row">
    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">Forgot Password</div>
            <div class="panel-body">
                <form role="form" method="post"  action="{{ route('admin-forgotpassword') }}" id="forgotpasswordform">{{ csrf_field() }}
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="E-mail" name="email" type="email">
                        </div>
                        <button type="submit" class="btn btn-primary">Reset Password</button></fieldset>
                    </br>
                    <div class="form-group">
                        <a href="{{ route('admin-login') }}" >Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- /.col-->
</div><!-- /.row -->	
@endsection
