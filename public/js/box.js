var xmlhttp;
var content = "<style>"+
"#advisr-recommendations {"+
"    list-style-type: none;"+
"    overflow: hidden;"+
"}"+
"#advisr-recommendations #advisr-recommend {"+
"    display:inline-block;"+
"    width:200px;"+
"    text-align: center;"+
"}"+
"#advisr-recommendations img {"+
"    display:block;"+
"    margin:auto;"+
"}"+
"</style>";

if (window.XMLHttpRequest)
{
	// code for IE7+, Firefox, Chrome, Opera, Safari
	xmlhttp=new XMLHttpRequest();
}
else
{	
	// code for IE6, IE5
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}


function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}

function deparam(query) {
    var pairs, i, keyValuePair, key, value, map = {};
    // remove leading question mark if its there
    if (query.slice(0, 1) === '?') {
        query = query.slice(1);
    }
    if (query !== '') {
        pairs = query.split('&');
        for (i = 0; i < pairs.length; i += 1) {
            keyValuePair = pairs[i].split('=');
            key = decodeURIComponent(keyValuePair[0]);
            value = (keyValuePair.length > 1) ? decodeURIComponent(keyValuePair[1]) : undefined;
            map[key] = value;
        }
    }
    return map;
}

document.addEventListener('DOMContentLoaded',function(){
	var advisr_user = getCookie("advisr_user");
	if(advisr_user == "")
	{
		var random_string = Math.random().toString(36).substring(10);
		setCookie("advisr_user", random_string, 1000);
		advisr_user = random_string;
	}
	
	if(typeof advisrApiKey == 'undefined')
		advisrApiKey = "";
	
	if(typeof advisrApiSecret == 'undefined')
		advisrApiSecret = "";
	
	if(typeof advisrDisplayBox  == 'undefined') {
        console.log("invalid display data");
        return;
    }
    var displayData = deparam(advisrDisplayBox);
		
	var advisrUrl = "http://localhost:8080/recommender/rest/api/recommend?apiKey="+advisrApiKey+"&apiSecret="+advisrApiSecret+"&toUser="+advisr_user+"&howMany=" + displayData['how_many'];
	

	
	xmlhttp.open("GET",advisrUrl,true);
	//xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send();
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			//document.getElementById("advisr-box").innerHTML=xmlhttp.responseText;
			var resp = JSON.parse(xmlhttp.responseText);
			content += "<div id='advisr-recommendations' >";
			console.log(resp);
			for(var i in resp){
                console.log(resp[i]);
				//content += '<li><a href="'+ resp[i].url + '">' + resp[i].url + '</a></li>';
                content += '<div id="advisr-recommend"><a href="'+resp[i].url+'"><img src="'+resp[i].photo_url+'" style="width:150px; height:150px" />'+resp[i].item_name+'</a></div>';
				console.log(resp[i].url);
			}
			content += "</div>";
			document.getElementById("advisr-box").innerHTML=content;
            var elemContainer = document.getElementById("advisr-recommendations");

            elemContainer.style.borderColor = "#"+ displayData['border_color'];
            elemContainer.style.borderStyle = "solid";
            elemContainer.style.borderWidth = displayData['border_width'] + "px";
            elemContainer.style.width = displayData['box_width'] + "px";
		}
	}
});