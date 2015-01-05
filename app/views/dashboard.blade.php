@extends('layout.main')

@include('modals/add-app')
@include('modals/add-category')

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

        <div class="col-md-2">

            <div class="sidebar dashboard-sidebar">
                <a class="btn btn-primary" data-toggle="modal" data-target="#addAppModal" role="button">ADD APP</a>
            </div>

            <div class="sidevar dashboard-sidebar">
                <a class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal" role="button">ADD CATEGORY</a>
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
                                '{{ URL::to('categories'); }}'
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

        <div class="col-md-10">

            <h1>Dashboard</h1>

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