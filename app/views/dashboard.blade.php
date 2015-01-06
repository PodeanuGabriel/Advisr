@extends('layout.main')

@include('modals/add-app')

@section('content')

<?php if(count($errors)) : ?>

    <?php var_dump($errors); ?>

    <div class="alert alert-error">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Error!</strong> A problem occurred while submitting your data.
    </div>

<?php endif; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-11 col-md-offset-1 col-sm-12">
            <h1 class="page-title">DASHBOARD</h1>
        </div>
    </div>
    <div class="row">

        <div class="col-md-2 col-md-offset-1 left-menu">

            <div class="sidebar dashboard-sidebar text-center">
                <a class="btn btn-less-dark" data-toggle="modal" data-target="#addAppModal" role="button">ADD APP</a>
            </div>

            <div class="sidebar dashboard-sidebar">
                <ul id="appList" class="nav nav-sidebar">
                    <?php
                    foreach($apps as $app)
                    {
                    ?>

                    <li>
                        <a id="<?php echo $app->id; ?>"
                            onclick="getAppDetails(
                                this.id,
                                '{{ URL::to('app-get'); }}',
                                '{{ URL::to('app-edit'); }}',
                                '{{ URL::to('app-recommendation'); }}',
                                '{{ URL::to('app-users') }}',
                                '{{ URL::to('categories'); }}',
                                '{{ URL::to('app-categories-edit'); }}'
                            );"
                        >
                            <?php echo str_replace('\'', '', $app->name); ?>
                        </a>
                    </li>

                    <?php
                    }
                    ?>
                </ul>
            </div>

            <div style="clear:both"></div>

        </div>

        <div class="col-md-9 main-information">

            

            <ul class="nav nav-tabs" data-tabs="tabs">
                <li class="active"><a href="#apps" data-toggle="tab">App Info</a></li>
                <li><a href="#embedded" data-toggle="tab">Code to embed</a></li>
                <li><a href="#statistics" data-toggle="tab">Statistics</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="apps">
                    <div class="placeholders">
                        <h3 class="page-header">Edit app</h3>
                        <div id="appDetails" class="col-sm-12 placeholder"></div>

                        <div style="clear:both"></div>

                        <h3 class="page-header">Get recommendations</h3>
                        <div id="appRecommendations" class="col-sm-12 placeholder"></div>

                        <div style="clear:both"></div>

                        <div id="recommendationList"></div>
                    </div>

                    <div style="clear:both"></div>
                </div>

                <div class="tab-pane" id="embedded">
                    <h3 class="page-header">What to add</h3>
                    <br/>
                    <p>In order to add users to registered app you need to embed the following code snippet into your web page code.</p>
                    <br/>
                    <p>
                        <code>
                            <span>&lt;div id="advisr-box"&gt;&lt;/div&gt;</span><br/>
                            <br/>
                            <span>&lt;script&gt;</span><br/>
                            <span>var advisrApiKey = 'TEST';</span><br/>
                            <span>var advisrApiSecret = 'TEST';</span><br/>
                            <span>var advisrHowMany = 3;</span><br/>
                            <span>&lt;/script&gt;</span><br/>
                            <br/>
                            <span>&lt;script type="text/javascript" src="box.js"&gt;&lt;/script&gt;</span>
                        </code>
                    </p>
                    <br/>
                    <p>The <code>advisrApikey</code> and <code>advisrApiSecret</code> variables have to contain the actual API_KEY and API_SECRET received upon adding an app.</p>
                </div>

                <div class="tab-pane" id="statistics">

                </div>
            </div>

        </div>

    </div>
</div>

<script>

    window.addEventListener(
        "load",
        function()
        {
            $("#appList li:first-child a:first-child").trigger("click");
        },
        false
    );

</script>

@stop