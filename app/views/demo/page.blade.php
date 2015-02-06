@extends('layout.main')

@include('modals/add-app')
@include('modals/recommendations')

@section('content')

<h1>Produse</h1>

<ul>
    <li><a href="{{ Url::to('/demo/page1') }} ">Frigider Combina</a></li>
    <li><a href="{{ Url::to('/demo/page2') }} ">Alt Frigider Combina</a></li>
    <li><a href="{{ Url::to('/demo/page3') }} ">Masina</a></li>
    <li><a href="{{ Url::to('/demo/page4') }} ">Alta Masina</a></li>
    <li><a href="{{ Url::to('/demo/page5') }} ">Inca o Masina</a></li>
    <li><a href="{{ Url::to('/demo/page6') }} ">Haine</a></li>
    <li><a href="{{ Url::to('/demo/page7') }} ">Alte haine</a></li>
    <li><a href="{{ Url::to('/demo/page8') }} ">Tot haine</a></li>
</ul>

<div id="advisr-box"></div>
<script>
    var advisrApiKey = 'TEST';
    var advisrApiSecret = 'TEST';
    var advisrDisplayBox = 'how_many=3&box_width=600&thumbnail_width=200&thumbnail_height=200&border_width=2&border_color=1888d9';
</script>

<script type="text/javascript" src="http://localhost/AdvisrNew/public/js/box.js"></script>

@stop