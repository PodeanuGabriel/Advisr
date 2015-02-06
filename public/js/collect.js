
var xmlhttp;
var url = "http://localhost:8080/recommender/rest/api/add-preference";
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
	
	if(typeof advisrName == 'undefined')
		advisrName = "generic";
	
	if(typeof advisrPhoto == 'undefined')
		advisrPhoto = "nimic";
		
	xmlhttp.open("POST",url,true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	
	advisrName = encodeURIComponent(advisrName);
	//console.log(advisrName);
	advisrPhoto = encodeURIComponent(advisrPhoto);
	advisrCategory = encodeURIComponent(advisrCategory);
	
	var post_url = "url="+document.URL+"&user_id="+advisr_user+"&category="+advisrCategory + "&name="+advisrName + "&photo="+advisrPhoto+"&appKey="+advisrApiKey+"&appSecret="+advisrApiSecret;
	
	xmlhttp.send(post_url);
});