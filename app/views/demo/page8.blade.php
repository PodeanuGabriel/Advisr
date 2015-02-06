@extends('layout.main')

@include('modals/add-app')
@include('modals/recommendations')

@section('content')
<h1>Tot haine</h1>
<img src="http://static.guim.co.uk/sys-images/Guardian/Pix/pictures/2013/10/15/1381833396660/jumpers---weekend-fashion-009.jpg" style="height:500px" />
<h2>Pret: 1065$</h2>

<script>

    var advisrCategory = 'haine';
    var advisrName = 'Tot haine';
    var advisrApiKey = 'TEST';
    var advisrApiSecret = 'TEST';
    var advisrPhoto = 'http://static.guim.co.uk/sys-images/Guardian/Pix/pictures/2013/10/15/1381833396660/jumpers---weekend-fashion-009.jpg';
</script>
<script type="text/javascript" src="http://localhost/AdvisrNew/public/js/collect.js"></script>

@stop