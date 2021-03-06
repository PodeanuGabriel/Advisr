@extends('layout.main')

@include('modals/add-app')
@include('modals/delete-app')
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
    <div class="row dashboard-content">
        <div class="col-md-2 col-md-offset-1 left-menu">
            
            <h1 class="page-title">DASHBOARD</h1>
            
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
                        <a class="app_item" id="<?php echo $app->id; ?>" onclick="getAppDetails(
                                this.id,
                                '{{ URL::to('app-get'); }}',
                                '{{ URL::to('app-users') }}',
                                '{{ URL::to('categories'); }}',
                                (
                                    function(nAppID)
                                    {
                                        document.getElementById('app_statistics_tab').addEventListener(
                                            'click',
                                            function()
                                            {
                                                getAppStatisticsByAccess('{{ URL::to('app-statistics-access') }}', nAppID, 'appStatisticsByAccess');
                                                getAppStatisticsByPreference('{{ URL::to('app-statistics-preference') }}', nAppID, 'appStatisticsByPreference');
                                            },
                                            false
                                        );
                                    }
                                )(this.id)
                            );">
                            <?php echo $app->name; ?>

                            <span class="glyphicon glyphicon-trash pull-right" data-toggle="modal" data-target="#deleteAppModal"></span>
                        </a>
                    </li>

                    <?php
                    }
                    ?>
                </ul>
            </div>

            <div style="clear:both"></div>

        </div>

        <div class="col-md-8 main-information">
            <?php
            if(count($apps) > 0)
            {
            ?>
            <ul id="app_tabs" class="nav nav-tabs" data-tabs="tabs">
                <li class="active"><a id="app_details_tab" href="#apps" data-toggle="tab">App Info</a></li>
                <li><a id="embed_code_tab" href="#embedded" data-toggle="tab">Code to embed</a></li>
                <li><a id="app_statistics_tab" href="#statistics" data-toggle="tab">Statistics</a></li>
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

                <!-- embed -->
                <div class="tab-pane" id="embedded">
                    <h3 class="page-header">How to collect data</h3>
                    <br/>
                    <div id="how-to-collect"></div>


                    <h3 class="page-header">How to view data</h3>
                    <br/>
                    <div id="how-to-view"></div>

                    <h3 class="page-header">Get your own design</h3>
                    <form id="display-data">
                        <div class="row">
                            <div class="col-md-3">
                                <label>Recommendations number:</label>
                                <input name="how_many" class="form-control" id="how_many" onchange="setAttributes()" placeholder="How many "  value="1"/>                                
                            </div>
                            <div class="col-md-3">
                                <label>Box width:</label>
                                <input name="box_width" class="form-control" id="box_width" onchange="setAttributes()" placeholder="Box width (px) " />
                            </div>                            
                            <div class="col-md-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Thumbnails: </label>
                                        <input name="thumbnail_width" class="form-control" id="thumbnail_width" 
                                               onchange="setAttributes()" placeholder="Thumbnail width (px)" 
                                               value="2" />
                                    </div>
                                    <div class="col-md-12">
                                        <input name="thumbnail_height" class="form-control" id="thumbnail_height"
                                               onchange="setAttributes()" placeholder="Thumbnail height (px)" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Border: </label>
                                        <input name="border_width" class="form-control" id="border_width" 
                                               onchange="setAttributes()" placeholder="Border width (px)" 
                                               value="2" />
                                    </div>
                                    <div class="col-md-12">
                                        <input name="border_color" class="form-control" id="border_color" 
                                               placeholder="Border Color" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <style>
                        #advisr-recommendations {
                            list-style-type: none;
                            overflow: hidden;

                        }
                        #advisr-recommendations #advisr-recommend {
                            display:inline-block;
                            width:200px;
                            text-align: center;
                        }
                        #advisr-recommendations img {
                            display:block;
                            margin:auto;
                        }
                    </style>
                    <div id="advisr-recommendations">
                        <div id="advisr-recommend">
                            <a href="http://google.ro">
                                <img class="advisr-thumb" src="http://www.aamu.edu/news/2011/Documents/Tree.png" style="width:150px; height:150px" />
                                recomandare 1
                            </a>
                        </div>

                    </div>
                </div>
                <!-- END embed -->

                <div class="tab-pane" id="statistics">

                    <h3 class="page-header">Statistics</h3>
                    <div id="appStatisticsByAccess" class="col-sm-12 placeholder"></div>
                    <div id="appStatisticsByPreference" class="col-sm-12 placeholder"></div>

                    <div style="clear:both"></div>

                </div>

                <div style="clear:both"></div>
            </div>
            <?php
            }
            else {
            ?>
            <div class="no-apps">
                <p>
                    You haven't added any app yet.
                </p>
                <a class="btn btn-dark" data-toggle="modal" data-target="#addAppModal" role="button">
                    Add your first app
                </a>
            </div>
            <?php
            }
            ?>

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

            renderCodeToEmbed("{{ URL::to('app-get') }}", "{{ URL::asset('js/collect.js') }}", "{{ URL::asset('js/box.js') }}");

            $('#border_color').colpick(
                {
                    layout:'hex',
                    submit:0,
                    colorScheme:'dark',
                    onChange:function(hsb,hex,rgb,el,bySetColor)
                    {
                        //$(el).css('border-color','#'+hex);
                        // Fill the text box just if the color was set using the picker, and not the colpickSetColor function.
                        if(!bySetColor)
                            $(el).val(hex);

                        setAttributes();
                    }
                }
            ).keyup(function(){ $(this).colpickSetColor(this.value); });

            setAttributes();
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