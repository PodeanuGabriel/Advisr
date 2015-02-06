var xmlhttp;
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
	
	if(typeof advisrHowMany == 'undefined')
		advisrHowMany = 3;
		
	var advisrUrl = "http://localhost:8080/recommender/rest/api/recommend?apiKey="+advisrApiKey+"&apiSecret="+advisrApiSecret+"&toUser="+advisr_user+"&howMany=" + advisrHowMany;
	
	
	
	xmlhttp.open("GET",advisrUrl,true);
	//xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send();
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			//document.getElementById("advisr-box").innerHTML=xmlhttp.responseText;
			var resp = JSON.parse(xmlhttp.responseText);
			var content = "<ul>";
			console.log(resp);
			for(var i in resp){
				content += '<li><a href="'+ resp[i].url + '">' + resp[i].url + '</a></li>';
				console.log(resp[i].url);
			}
			content += "</ul>";
			document.getElementById("advisr-box").innerHTML=content;
		}
	}
});