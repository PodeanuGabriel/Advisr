<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Advisr</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ URL::asset('css/bootstrap.min.css'); }}" rel="stylesheet">
    <link href="{{ URL::asset('css/bootstrapValidator.min.css'); }}" rel="stylesheet">
    <link href="{{ URL::asset('css/style.css'); }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    <script src="{{ URL::asset('js/jquery-1.11.1.min.js'); }}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js'); }}"></script>

    <script src="{{ URL::asset('js/dashboard.js'); }}"></script>

</head>
<body>
    @include('navbar')

    <div class="container-fluid marketing">
        @yield('content')
    </div>

</body>
</html>