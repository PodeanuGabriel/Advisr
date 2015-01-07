
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

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href="{{ URL::asset('css/carousel.css'); }}" rel="stylesheet">

    <link href="{{ URL::asset('css/style.css'); }}" rel="stylesheet">

    <script src="{{ URL::asset('js/jquery-1.11.1.min.js'); }}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js'); }}"></script>

    <script src="{{ URL::asset('js/dashboard.js'); }}"></script>

</head>
<!-- NAVBAR
================================================== -->
<body>

@include('navbar')

@include('modals/register')

<!-- Carousel
================================================== -->
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="item active">
            <div class="container">
                <div class="carousel-caption">
                    <h1>Blazin' fast recommender service for application owners</h1>
                    <p>Improve your application's experience in a matter of minutes</p>
                    <p><a class="btn btn-dark btn-lg btn-primary" data-toggle="modal" data-target="#registerModal" role="button">Sign up today</a></p>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="container">
                <div class="carousel-caption">
                    <h1>Easy to get, easy to use. </h1>
                    <p><a class="btn btn-dark btn-lg btn-primary" role="button">View documentation</a></p>
                </div>
            </div>
        </div>        
        <div class="item">
            <div class="container">
                <div class="carousel-caption">
                    <h1>You're just one step away from having accurate recommendations on your web site.</h1>
                    <p><a class="btn btn-dark btn-lg btn-primary" data-toggle="modal" data-target="#registerModal" role="button">Sign up today</a></p>
                </div>
            </div>
        </div>

    </div>
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
</div><!-- /.carousel -->



<!-- Marketing messaging and featurettes
================================================== -->
<!-- Wrap the rest of the page in another container to center all the content. -->

<div class="container marketing">

    <!-- START THE FEATURETTES -->
    <hr class="featurette-divider">
    
    <div class="row featurette">
        <div class="col-md-7">
            <h2 class="featurette-heading"> Easy to integrate. <span class="text-muted"> Easy to use. </span></h2>
            <p class="lead"> Integrating custom recommendation in your website is now easier than you thought. All you have to do is include a library and follow the specifications from documentation. Regarding these, you'll get your users favorite items to display.</p>
        </div>
        <div class="col-md-5">
            <img class="featurette-image img-responsive" src='{{ URL::asset('img/coding.jpg'); }}' alt="Generic placeholder image">
        </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
        <div class="col-md-5">
            <img class="featurette-image img-responsive" src='{{ URL::asset('img/increase-rate.jpg'); }}' alt="Generic placeholder image">
        </div>
        <div class="col-md-7">
            <h2 class="featurette-heading"> Become users' addiction. <span class="text-muted"> Captivate them. </span></h2>
            <p class="lead"> Once your users get relevant recommendations regarding their preferences, they will definitely enjoy surfing on your web site and will get captured by their favorite items.</p>
        </div>
    </div>

    <hr class="featurette-divider">
    
    <div class="row featurette">
        <div class="col-md-7">
            <h2 class="featurette-heading"> Expand your visitors. <span class="text-muted"> Make them recommend you. </span></h2>
            <p class="lead"> By satisfying your visitors your web site will become more popular and your rating your increase considerably. </p>
        </div>
        <div class="col-md-5">
            <img class="featurette-image img-responsive" src='{{ URL::asset('img/available.jpg'); }}' alt="Generic placeholder image">
        </div>
    </div>   
    
    <hr class="featurette-divider">

</div><!-- /.container -->
<div class='container-fluid'>
    @include('footer')
</div>
</body>
</html>
