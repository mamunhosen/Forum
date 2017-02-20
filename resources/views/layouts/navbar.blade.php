<nav class="navbar navbar-default navbar-fixed-top ">
  <div class="container-fluid">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class="active"><a href="{{route('home')}}">HOME</a></li>
          <li><a href="#">ABOUT</a></li>
          <li><a href="#">CONTACT US</a></li>
        </ul>
        <form class="navbar-form navbar-left">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Search" name="search">
          </div>
          <button type="submit" class="btn btn-default">Go</button>
        </form>
        <ul class="nav navbar-nav navbar-right">
          @if(Auth::check())
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;Profile</a></li>
              <li class="divider"></li>
              <li><a href="{{route('new_blog')}}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>&nbsp;Write New Topic</a></li>
              <li class="divider"></li>
              <li><a href="{{route('logout')}}"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Logout</a></li>
            </ul>
          </li>
          @else
          <li><a href="{{route('auth')}}">SIGN IN / REGISTER</a></li>
          @endif
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
  </div><!-- /.container-fluid -->
</nav>