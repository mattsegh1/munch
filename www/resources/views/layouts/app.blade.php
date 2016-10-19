<!-- MASTER PAGE FOR BACKOFFICE (APP) PAGES -->

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../favicon.ico">

    <title>Munch - Admin Panel</title>

    <!-- Bootstrap core CSS -->
    <link href="<?= asset('css/app.css'); ?>" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false"
                    aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">
                <img alt="Brand" src="<?= asset('img/munch_logo_white.png'); ?>">
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">

                <li class="visible-xs">
                    <a href="{{ url('/') }}">
                        <i class="fa fa-tachometer"></i> Dashboard
                    </a>
                </li>
                <li role="separator" class="divider"></li>
                <li class="visible-xs">
                    <a href="{{ url('product') }}">
                        <i class="fa fa-book"></i> Producten
                    </a>
                </li>
                <li class="visible-xs">
                    <a href="{{ url('category') }}">
                        <i class="fa fa-tag"></i> Categorieën
                    </a>
                </li>
                <li class="visible-xs">
                    <a href="{{ url('manufacturer') }}">
                        <i class="fa fa-building"></i> Producenten
                    </a>
                </li>
                <li role="separator" class="divider"></li>
                <li class="visible-xs">
                    <a href="{{ url('order') }}">
                        <i class="fa fa-truck"></i> Orders
                    </a>
                </li>
                <li class="visible-xs">
                    <a href="{{ url('customer') }}">
                        <i class="fa fa-male"></i> Klanten
                    </a>
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                       aria-expanded="false">
                        @if(Auth::user()->avatar_url != "")
                            <img src="{{ Auth::user()->avatar_url }}" class="profile_image img-circle hidden-xs">
                        @else
                            <img src="{{ asset('img/default_avatar.png') }}" class="profile_image img-circle hidden-xs">
                        @endif
                        <span class="username">{{ Auth::user()->username }}</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i> Afmelden</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li {{ Request::is('/' . '*') ? ' class=active' :  '' }}>
                    <a href="{{ url('/') }}">
                        <i class="fa fa-tachometer"></i> Dashboard
                    </a>
                </li>
                <li role="separator" class="divider"></li>
                <li {{ Request::is('product' . '*') ? ' class=active' :  '' }}>
                    <a href="{{ url('product') }}">
                        <i class="fa fa-book"></i> Producten
                    </a>
                </li>
                <li {{ Request::is('category' . '*') ? ' class=active' :  '' }}>
                    <a href="{{ url('category') }}">
                        <i class="fa fa-tag"></i> Categorieën
                    </a>
                </li>
                <li {{ Request::is('manufacturer' . '*') ? ' class=active' :  '' }}>
                    <a href="{{ url('manufacturer') }}">
                        <i class="fa fa-building"></i> Producenten
                    </a>
                </li>
                <li role="separator" class="divider"></li>
                <li {{ Request::is('order' . '*') ? ' class=active' :  '' }}>
                    <a href="{{ url('order') }}">
                        <i class="fa fa-truck"></i> Orders
                    </a>
                </li>
                <li {{ Request::is('customer' . '*') ? ' class=active' :  '' }}>
                    <a href="{{ url('customer') }}">
                        <i class="fa fa-male"></i> Klanten
                    </a>
                </li>
            </ul>
            <ul class="nav nav-sidebar">
                <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i> Afmelden</a></li>
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            @include('partials.flash')
            @yield('content')
        </div><!-- END MAIN -->
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
    window.jQuery || document.write('<script src="js/vendor/jquery.min.js"><\/script>')
</script>
<script
        src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
        integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="
        crossorigin="anonymous">

</script>
<script src="<?= asset('js/vendor/bootstrap.min.js'); ?>"></script>
<script src="<?= asset('js/vendor/chart.min.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.6.1/lodash.min.js"></script>
<script src="<?= asset('js/vendor/bootbox.min.js'); ?>"></script>
<script src="<?= asset('js/all.js'); ?>"></script>


<script>
    $('div.alert').not('alert-important').delay(3000).slideUp(300);
</script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<!-- jquery UI -->
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script>
    $(function () {
        $(".datepicker").datepicker({dateFormat: 'yy-mm-dd'});
    });
</script>


</body>

</html>