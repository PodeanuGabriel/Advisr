@extends('layout.main')

@include('modals/add-app')
@include('modals/recommendations')

@section('content')
<h1>Alt Frigider Combina</h1>
<img src="http://image.haier.com/us/products/kitchen/refrigerators/compact-refrigerators/W020130506648603575135.png" style="height:500px" />
<h2>Pret: 1065$</h2>

<script>

    var advisrCategory = 'frigider';
    var advisrName = 'Alt Frigider Combina';
    var advisrApiKey = 'TEST';
    var advisrApiSecret = 'TEST';
    var advisrPhoto = 'http://image.haier.com/us/products/kitchen/refrigerators/compact-refrigerators/W020130506648603575135.png';
</script>
<script type="text/javascript" src="http://localhost/AdvisrNew/public/js/collect.js"></script>

@stop