<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ URL::to('/') }}">Advisr</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-left">
                <li><a href="#about">About</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Nav header</li>
                        <li><a href="#">Separated link</a></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (!Auth::check())
                    <li class="dropdown" id="menuLogin">

                        <a class="dropdown-toggle" href="#" data-toggle="dropdown" id="navLogin">Login</a>
                        <div class="dropdown-menu" id="login-dropdown" >

                            @if ($message = Session::get('errors_login'))
                            <script>
                                $(document).ready(function(){
                                    $('#login-dropdown').show();
                                });
                            </script>
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                            @endif

                            <form method="post" action="{{ Url::to('login') }}">
                                <div class="col-sm-12">
                                    <div class="spacer-top spacer-bottom col-sm-12">
                                        <label for="email">Email</label>
                                        <input type="text" placeholder="Email" name="email" onclick="return false;" class="form-control input-sm" id="email" />
                                    </div>
                                    <div class="spacer-bottom col-sm-12">
                                        <label for="password">Password</label>
                                        <input type="password" placeholder="Password" name="password" class="form-control input-sm" id="password" />
                                    </div>
                                    <div class="spacer-bottom col-sm-12">
                                        <button type="submit" class="btn btn-success btn-sm">Sign in</button>
                                    </div>
                                </div>

                                <div style="clear:both"></div>
                             </form>
                        </div>

                    </li>
                @else
                    <li><a href="{{ Url::to('logout') }}">Logout</a></li>
                @endif
            </ul>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('.dropdown-menu input').click(function (event) {
            event.stopPropagation();
        });
    });
</script>