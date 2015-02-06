@extends('layout.main')

@section('content')
<!-- embed -->
<div class="container-fluid">
    <div class="row documentation-content">
        <h1 class="page-title">Documentation</h1>
    <div class="tab-pane" id="embedded">
        <h3 class="page-header">How to collect data</h3>
        <br/>
        <div id="how-to-collect">
                <p>In order to collect data on items you need to embed the following code snippet into your web page code.</p>
                    <p>
                    <code>
                    <span>&lt;script&gt;</span><br/>
                    <span>var advisrCategory = 'haine';</span><br/>
                    <span>var advisrName = 'item1';</span><br/>
                    <span>var advisrApiKey = 'A8947fjhbfdXXD';</span><br/>
                    <span>var advisrApiSecret = 'ds656jXCzfdDgfDDFgfh8f'</span><br/>
                    <span>var advisrPhoto = 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcQdWU51VMKb1vZBZENSVHEXsg03CNV6WNpjaWyGZu0phA1mjOcn';</span><br/>
                    <span>&lt;/script&gt;</span><br/>
                    <br/>
                    <span>&lt;script type=\"text/javascript\" src="js/collect.js"&gt;&lt;/script&gt;</span>
                    </code>
                    </p>
                    <br/>
                    <p>The <code>advisrCategory</code> variable should contain the category that the item belongs to.</p>
                    <p>The <code>advisrName</code> variable should contain the name by which the item is identified.</p>
                    <p>The <code>advisrPhoto</code> variable should contain the url to a photo of the item. This photo will appear along with the item in a recommendation result.</p>           
        </div>


        <h3 class="page-header">How to view data</h3>
        <br/>
        <div id="how-to-view">
            <p>In order to add users to registered app you need to embed the following code snippet into your web page code.</p>
                <br/>
                <p>
                <code>
                <span>&lt;div id=\"advisr-box\"&gt;&lt;/div&gt;</span><br/>
                <span>&lt;script&gt;</span><br/>
                <span>var advisrApiKey = 'A8947fjhbfdXXD';</span><br/>
                <span>var advisrApiSecret = 'ds656jXCzfdDgfDDFgfh8f';</span><br/>
                <span>var advisrDisplayBox = '<span id=\"display-box-data\"></span>';</span><br/>
                <span>&lt;/script&gt;</span><br/>
                <br/>
                <span>&lt;script type="text/javascript" src="http://lol.com/hello.jpg"&gt;&lt;/script&gt;</span>
                </code>
                </p>
                <br/>
                <p>The <code>advisrApikey</code> and <code>advisrApiSecret</code> variables have to contain the actual API_KEY and API_SECRET received upon adding an app.</p>           
        </div>

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
                                   placeholder="Thumbnail height (px)" />
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
                    <img src="http://www.aamu.edu/news/2011/Documents/Tree.png" style="width:150px; height:150px" />
                    recomandare 1
                </a>
            </div>

        </div>
    </div>
    </div>
</div>
@stop