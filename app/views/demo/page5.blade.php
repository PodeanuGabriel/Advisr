@extends('layout.main')

@include('modals/add-app')
@include('modals/recommendations')

@section('content')
<h1>Inca o Masina</h1>
<img src="http://cdn.drivingfutures.com/3_car.png" style="height:500px" />
<h2>Pret: 1065$</h2>

<script>

    var advisrCategory = 'automobile';
    var advisrName = 'Inca o Masina';
    var advisrApiKey = 'TEST';
    var advisrApiSecret = 'TEST';
    var advisrPhoto = 'http://cdn.drivingfutures.com/3_car.png';
</script>
<script type="text/javascript" src="http://localhost/AdvisrNew/public/js/collect.js"></script>

@stop