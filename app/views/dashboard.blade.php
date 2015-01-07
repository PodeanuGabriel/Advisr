@extends('layout.main')

@include('modals/add-app')
@include('modals/recommendations')

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
                        <a id="<?php echo $app->id; ?>" onclick="getAppDetails(this.id, '{{ URL::to('app-get'); }}', '{{ URL::to('app-users') }}', '{{ URL::to('categories'); }}');">
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

            <ul id="app_tabs" class="nav nav-tabs" data-tabs="tabs">
                <li class="active"><a href="#apps" data-toggle="tab">App Info</a></li>
                <li><a href="#embedded" data-toggle="tab">Code to embed</a></li>
                <li><a href="#statistics" data-toggle="tab">Statistics</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="apps">

                    <div class="placeholders">

                        <h3 class="page-header">Credentials</h3>
                        <div id="appCredentials" class="col-sm-12 placeholder">
                            <form id="formForAppCredetials"class="col-sm-9 form-horizontal">

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">API Key:</label>
                                    <div id="api_key" class="col-sm-6 control-label"></div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">API Secret:</label>
                                    <div id="api_secret" class="col-sm-6 control-label"></div>
                                </div>

                            </form>

                            <div style="clear:both"></div>
                        </div>

                        <div style="clear:both"></div>

                        <h3 class="page-header">Edit app</h3>
                        <div id="appDetails" class="col-sm-12 placeholder">
                            <form id="formForAppDetails" class="col-sm-9 form-horizontal" method="POST" action='{{ URL::to('app-edit'); }}' onsubmit="generateFormURL(this);">

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">App name:</label>
                                    <div class="col-sm-6">
                                        <input id="app_name" type="text" name="name" value="" class="form-control" required="required" aria-required="true" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">App data URL:</label>
                                    <div class="col-sm-6">
                                        <input id="app_url" type="url" name="data_url" value="" class="form-control" required="required" aria-required="true" />
                                    </div>
                                </div>

                                <div class="col-sm-9 modal-footer">
                                    <input type="submit" value="Save" class="btn btn-less-dark" />
                                </div>

                            </form>

                            <div style="clear:both"></div>
                        </div>

                        <div style="clear:both"></div>

                        <h3 class="page-header">Get recommendations</h3>
                        <div id="appRecommendations" class="col-sm-12 placeholder">
                            <form id="formForAppRecommendations" class="col-sm-9 form-horizontal" method="POST" action="{{ URL::to('app-categories-edit'); }}" onsubmit="generateFormURL(this);">

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">App users:</label>
                                    <div class="col-sm-6">
                                        <select id="app_users" form="formForappRecommendations" class="form-control"></select>
                                    </div>
                                </div>

                                <div class="form-group">
                                            <label class="col-sm-3 control-label">Item count</label>
                                            <div class="col-sm-6">
                                                <input id="item_count" type="number" value="1" min="1" max="1000" class="form-control" />
                                            </div>
                                        </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Categories:</label>
                                    <div class="col-sm-6">
                                        <ul id="app_categories" class="list-unstyled"></ul>
                                    </div>
                                </div>

                                <div class="col-sm-9 modal-footer">
                                    <input type="submit" value="Save" class="btn btn-less-dark" />
                                    <input id="app_recommendations" type="hidden" value="Get recommendations" onclick="getAppRecommendations();" class="btn btn-light" data-toggle="modal" data-target="#recommendationsModal" />
                                </div>

                            </form>

                            <div style="clear:both"></div>
                        </div>

                        <div style="clear:both"></div>

                    </div>

                    <div style="clear:both"></div>
                </div>

                <div class="tab-pane" id="embedded">
                    <h3 class="page-header">How to collect data</h3>
                    <br/>
                    <p>In order to collect data on items you need to embed the following code snippet into your web page code.</p>
                    <p>
                        <code>
                            <span>&lt;script&gt;</span><br/>
                            <br/>
                            <span>var advisrCategory = 'haine';</span><br/>
                            <span>var advisrName = 'item1';</span><br/>
                            <span>var advisrPhoto = 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcQdWU51VMKb1vZBZENSVHEXsg03CNV6WNpjaWyGZu0phA1mjOcn';</span><br/>
                            <span>&lt;/script&gt;</span><br/>
                            <br/>
                            <span>&lt;script type="text/javascript" src="collect.js"&gt;&lt;/script&gt;</span>
                        </code>
                    </p>
                    <br/>
                    <p>The <code>advisrCategory</code> variable should contain the category that the item belongs to.</p>
                    <p>The <code>advisrName</code> variable should contain the name by which the item is identified.</p>
                    <p>The <code>advisrPhoto</code> variable should contain the url to a photo of the item. This photo will appear along with the item in a recommendation result.</p>

                    <h3 class="page-header">How to view data</h3>
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
                    <h3 class="page-header">Statistics</h3>
                </div>
            </div>

        </div>

    </div>

    <div id="advisr-box" class="hidden"></div>

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

<script>
    var advisrApiKey = 'TEST';
    var advisrApiSecret = 'TEST';
    var advisrHowMany = 3;
</script>
<script type="text/javascript" src="{{ URL::asset('js/box.js'); }}"></script>

@stop