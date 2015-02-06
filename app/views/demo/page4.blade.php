@extends('layout.main')

@include('modals/add-app')
@include('modals/recommendations')

@section('content')
<h1>Alta Masina</h1>
<img src="http://www.webuycarsformore.com/wp-content/uploads/2014/05/car-blogspot-blue.png" style="height:500px" />
<h2>Pret: 1065$</h2>

<script>

    var advisrCategory = 'automobile';
    var advisrName = 'Alta Masina';
    var advisrApiKey = 'TEST';
    var advisrApiSecret = 'TEST';
    var advisrPhoto = 'http://www.webuycarsformore.com/wp-content/uploads/2014/05/car-blogspot-blue.png';
</script>
<script type="text/javascript" src="http://localhost/AdvisrNew/public/js/collect.js"></script>

@stop