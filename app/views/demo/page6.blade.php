@extends('layout.main')

@include('modals/add-app')
@include('modals/recommendations')

@section('content')
<h1>Haine</h1>
<img src="http://images.all-free-download.com/images/graphiclarge/clothes_template_20_vector_160650.jpg" style="height:500px" />
<h2>Pret: 1065$</h2>


<script>

    var advisrCategory = 'haine';
    var advisrName = 'Haine';
    var advisrApiKey = 'TEST';
    var advisrApiSecret = 'TEST';
    var advisrPhoto = 'http://images.all-free-download.com/images/graphiclarge/clothes_template_20_vector_160650.jpg';
</script>
<script type="text/javascript" src="http://localhost/AdvisrNew/public/js/collect.js"></script>

@stop