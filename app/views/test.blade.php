@extends('layout.main')

@section('content')

<div class="container-fluid">

    <div class="row">
        <div class="col-md-11 col-md-offset-1 col-sm-12">
            <h1 class="page-title">Test</h1>
        </div>
    </div>

    <div id="advisr-box"></div>

</div>

<script>
    var advisrCategory = 'automobile';
    var advisrName = 'item2';
    var advisrApiKey = 'TEST';
    var advisrApiSecret = 'TEST';
    var advisrPhoto = 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcQdWU51VMKb1vZBZENSVHEXsg03CNV6WNpjaWyGZu0phA1mjOcn';
</script>
<script type="text/javascript" src="{{ URL::asset('js/collect.js'); }}"></script>

<script>
    var advisrApiKey = 'TEST';
    var advisrApiSecret = 'TEST';
    var advisrDisplayBox = 'border_width=4&border_color=F8CA4D&box_width=800&how_many=3';
</script>
<script type="text/javascript" src="{{ URL::asset('js/box.js'); }}"></script>

@stop