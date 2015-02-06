@extends('layout.main')

@include('modals/add-app')
@include('modals/recommendations')

@section('content')
<h1>Alte haine</h1>
<img src="http://www.goodhousekeeping.com/cm/goodhousekeeping/images/mW/target-cherokee-clothes-0809-s3-medium_new.jpg" style="height:500px" />
<h2>Pret: 1065$</h2>

<script>

    var advisrCategory = 'haine';
    var advisrName = 'Alte haine';
    var advisrApiKey = 'TEST';
    var advisrApiSecret = 'TEST';
    var advisrPhoto = 'http://www.goodhousekeeping.com/cm/goodhousekeeping/images/mW/target-cherokee-clothes-0809-s3-medium_new.jpg';
</script>
<script type="text/javascript" src="http://localhost/AdvisrNew/public/js/collect.js"></script>

@stop