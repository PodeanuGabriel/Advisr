/**
 * Created by gabriel on 06/02/15.
 */
function setAttributes()
{
    $("#advisr-recommendations").css('border-style', "solid" );
    $("#advisr-recommendations").css('border-width', $("#border_width").val() + "px" );
    $("#advisr-recommendations").css('border-color', "#" + $("#border_color").val() );
    $("#advisr-recommendations").css('width', $("#box_width").val() + "px" );
    $(".advisr-thumb").css('width', $("#thumbnail_width").val() + "px");
    $(".advisr-thumb").css('height', $("#thumbnail_height").val() + "px");
    var cloned = $("#advisr-recommend");

    $("#advisr-recommendations").html('');
    for(i=1; i<=$("#how_many").val(); i++ ) {
        console.log("DS");
        cloned.clone().appendTo($("#advisr-recommendations"));
    }
    $("#display-box-data").html($("#display-data").serialize());
    //console.log($("#display-data").serialize());
}

function renderCodeToEmbed(strAppGetURL, strCollectURL, strViewURL)
{
    var elActiveAppID = $("#appList > li.active :first-child").attr("id");

    $.get(
        strAppGetURL+"/"+elActiveAppID,
        function(mxResponse)
        {
            var objResult = JSON.parse(mxResponse);
            if(objResult)
            {
                var elCodeToEmbedContainer = document.getElementById("how-to-collect");
                var strText = "<p>In order to collect data on items you need to embed the following code snippet into your web page code.</p>" +
                    "<p>" +
                    "<code>" +
                    "<span>&lt;script&gt;</span><br/>" +
                    "<span>var advisrCategory = 'haine';</span><br/>" +
                    "<span>var advisrName = 'item1';</span><br/>" +
                    "<span>var advisrApiKey = '"+ objResult["appkey"] +"';</span><br/>" +
                    "<span>var advisrApiSecret = '"+ objResult["appsecret"] +"';</span><br/>" +
                    "<span>var advisrPhoto = 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcQdWU51VMKb1vZBZENSVHEXsg03CNV6WNpjaWyGZu0phA1mjOcn';</span><br/>" +
                    "<span>&lt;/script&gt;</span><br/>" +
                    "<br/>" +
                    "<span>&lt;script type=\"text/javascript\" src=\""+strCollectURL+"\"&gt;&lt;/script&gt;</span>" +
                    "</code>" +
                    "</p>" +
                    "<br/>" +
                    "<p>The <code>advisrCategory</code> variable should contain the category that the item belongs to.</p>" +
                    "<p>The <code>advisrName</code> variable should contain the name by which the item is identified.</p>" +
                    "<p>The <code>advisrPhoto</code> variable should contain the url to a photo of the item. This photo will appear along with the item in a recommendation result.</p>";

                elCodeToEmbedContainer.innerHTML = strText;

                elCodeToEmbedContainer = document.getElementById("how-to-view");
                strText = "<p>In order to add users to registered app you need to embed the following code snippet into your web page code.</p>" +
                "<br/>" +
                "<p>" +
                "<code>" +
                "<span>&lt;div id=\"advisr-box\"&gt;&lt;/div&gt;</span><br/>" +
                "<span>&lt;script&gt;</span><br/>" +
                "<span>var advisrApiKey = '"+ objResult["appkey"] +"';</span><br/>" +
                "<span>var advisrApiSecret = '"+ objResult["appsecret"] +"';</span><br/>" +
                "<span>var advisrDisplayBox = '<span id=\"display-box-data\"></span>';</span><br/>" +
                "<span>&lt;/script&gt;</span><br/>" +
                "<br/>" +
                "<span>&lt;script type=\"text/javascript\" src=\""+strViewURL+"\"&gt;&lt;/script&gt;</span>" +
                "</code>" +
                "</p>" +
                "<br/>" +
                "<p>The <code>advisrApikey</code> and <code>advisrApiSecret</code> variables have to contain the actual API_KEY and API_SECRET received upon adding an app.</p>";

                elCodeToEmbedContainer.innerHTML = strText;
            }
        }
    );
}