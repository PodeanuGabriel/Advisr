@extends('layout.main')

@include('modals/add-app')
@include('modals/recommendations')

@section('content')
<h1>Masina</h1>
<img src="http://images.wisegeek.com/silver-car-isolated.jpg" style="height:500px" />
<h2>Pret: 1065$</h2>

<script>

    var advisrCategory = 'automobile';
    var advisrName = 'Masina';
    var advisrApiKey = 'TEST';
    var advisrApiSecret = 'TEST';
    var advisrPhoto = 'http://images.wisegeek.com/silver-car-isolated.jpg';
</script>
<script type="text/javascript" src="http://localhost/AdvisrNew/public/js/collect.js"></script>

@stop