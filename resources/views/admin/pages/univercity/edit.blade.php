@extends('admin.layout.app')
@section('content')
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span></button>
            <a class="navbar-brand" href="#"><span>Lumino</span>Admin</a>
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <em class="fa fa-envelope"></em><span class="label label-danger">15</span>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <div class="dropdown-messages-box"><a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="http://placehold.it/40/30a5ff/fff">
                                </a>
                                <div class="message-body"><small class="pull-right">3 mins ago</small>
                                    <a href="#"><strong>John Doe</strong> commented on <strong>your photo</strong>.</a>
                                    <br /><small class="text-muted">1:24 pm - 25/03/2015</small></div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box"><a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="http://placehold.it/40/30a5ff/fff">
                                </a>
                                <div class="message-body"><small class="pull-right">1 hour ago</small>
                                    <a href="#">New message from <strong>Jane Doe</strong>.</a>
                                    <br /><small class="text-muted">12:27 pm - 25/03/2015</small></div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="all-button"><a href="#">
                                    <em class="fa fa-inbox"></em> <strong>All Messages</strong>
                                </a></div>
                        </li>
                    </ul>
                </li>
                <li class="dropdown"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <em class="fa fa-bell"></em><span class="label label-info">5</span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li><a href="#">
                                <div><em class="fa fa-envelope"></em> 1 New Message
                                    <span class="pull-right text-muted small">3 mins ago</span></div>
                            </a></li>
                        <li class="divider"></li>
                        <li><a href="#">
                                <div><em class="fa fa-heart"></em> 12 New Likes
                                    <span class="pull-right text-muted small">4 mins ago</span></div>
                            </a></li>
                        <li class="divider"></li>
                        <li><a href="#">
                                <div><em class="fa fa-user"></em> 5 New Followers
                                    <span class="pull-right text-muted small">4 mins ago</span></div>
                            </a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div><!-- /.container-fluid -->
</nav>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Univercity</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Univercity</h1>
        </div>
    </div>



    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="card card-box">
                <div class="card-body " id="bar-parent3">
                    <form action="{{ route('edit-univercity',$univercity->id) }}" id='editunivercityform' class="" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group ">
                            <label class="control-label" >Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Univercity Name" value='{{ $univercity->name }}'>
                        </div>
                        <div class="form-group ">
                            <label class="control-label" >E-mail</label>
                            <input type="text" class="form-control" name="email" placeholder="Enter E-Mail" value='{{ $univercity->email }}'>
                        </div>
                        <div class="form-group ">
                            <label class="control-label" >User Name</label>
                            <input type="text" class="form-control" name="username" placeholder="Enter User Name" value='{{ $univercity->username }}'>
                        </div>
                        <!--                        <div class="form-group ">
                                                    <label class="control-label" >Password</label>
                                                    <input type="text" class="form-control" name="password" placeholder="Enter Password" value='{{ $univercity->password }}>
                                                </div>-->
                        <div class="form-group ">
                            <label class="control-label" >Old Images</label>
                            <img src="{{ url('public/uploads/univercity/'.$univercity['image'] ) }}" alt="unvercity_image" title="logo-unvercity_image" class="rounded mr-4" height="100" />
                        </div>
                        <div class="form-group ">
                            <label class="control-label" >Image</label>
                            <input type="file" id='image'  class="form-control" name="image">
                        </div>  

                        <div class="form-group">
                            <button type="submit" class="btn btn-info">Submit</button>
                            <button type="button" class="btn btn-default">Cancel</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection