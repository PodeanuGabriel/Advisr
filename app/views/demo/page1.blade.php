@extends('layout.main')

@include('modals/add-app')
@include('modals/recommendations')

@section('content')
<h1>Frigider Combina</h1>
<img src="http://www.kitchenaid.com/digitalassets/KFIV29PCMS/Standalone_1175X1290.jpg" style="height:500px" />
<h2>Pret: 65$</h2>

<script>

    var advisrCategory = 'frigider';
    var advisrName = 'Frigider Combina';
    var advisrApiKey = 'TEST';
    var advisrApiSecret = 'TEST';
    var advisrPhoto = 'http://www.kitchenaid.com/digitalassets/KFIV29PCMS/Standalone_1175X1290.jpg';
</script>

<script type="text/javascript" src="http://localhost/AdvisrNew/public/js/collect.js"></script>

@stop

