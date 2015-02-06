/**
 * Created by gabriel on 16/12/14.
 */
function renderRecommendationModal(mxModalBodyID, arrColumnNames, arrData)
{
    var elRecommendationModalBody = document.getElementById(mxModalBodyID);
    while (elRecommendationModalBody.firstChild)
    {
        elRecommendationModalBody.removeChild(elRecommendationModalBody.firstChild);
    }

    for(var objItem in arrData)
    {
        var elRecommendationTableBodyRow = document.createElement("tr");

        var elProductPhoto = document.createElement("td");
        var elPhoto = document.createElement("img");
        elPhoto.src = arrData[objItem]["photo_url"]
        elProductPhoto.appendChild(elPhoto);

        var elProductID = document.createElement("td");
        elProductID.innerHTML = arrData[objItem]["itemId"];

        var elProductURL = document.createElement("td");
        elProductURL.innerHTML = arrData[objItem]["url"];

        var elProductRating = document.createElement("td");
        elProductRating.innerHTML = arrData[objItem]["rating"];

        elRecommendationTableBodyRow.appendChild(elProductPhoto);
        elRecommendationTableBodyRow.appendChild(elProductID);
        elRecommendationTableBodyRow.appendChild(elProductURL);
        elRecommendationTableBodyRow.appendChild(elProductRating);

        elRecommendationModalBody.appendChild(elRecommendationTableBodyRow);
    }
}


function clearContents(mxParentID)
{
    var elAppDetails = document.getElementById(mxParentID);
    while (elAppDetails.firstChild)
    {
        elAppDetails.removeChild(elAppDetails.firstChild);
    }

}


function generateFormURL(mxFormReference)
{
    document.getElementById(mxFormReference.id).action = mxFormReference.action+"/"+mxFormReference.app_id;
}


function getAppRecommendations()
{
    var arrSelectedCheckboxes = [];

    var nAppID = document.getElementById("app_recommendations").app_id;

    var arrUsers = document.getElementById("app_users");
    var strUser = arrUsers.options[arrUsers.selectedIndex].value;

    var arrCheckboxes = $("#app_categories :input");
    for(var mxIndex in arrCheckboxes)
    {
        if(arrCheckboxes[mxIndex].checked)
            arrSelectedCheckboxes.push(arrCheckboxes[mxIndex].value);
    }

    setCookie("advisr_user", strUser, 1000);

    var advisrApiKey = document.getElementById("api_key").innerHTML;
    var advisrApiSecret = document.getElementById("api_secret").innerHTML;;
    var advisrUser = getCookie("advisr_user");
    var advisrHowMany = document.getElementById("item_count").value;

    var advisrUrl = "http://localhost:8080/recommender/rest/api/recommend?apiKey="+advisrApiKey+"&apiSecret="+advisrApiSecret+"&toUser="+advisrUser+"&howMany="+advisrHowMany;

    $.get(
        advisrUrl,
        function(mxResponse)
        {
            if(typeof mxResponse == "object")
            {
                var arrTableColumns = ["Item photo", "Item ID", "Rating", "URL"];

                renderRecommendationModal("recommendation_modal_body", arrTableColumns, mxResponse);
            }
        }
    );
}


function getAppDetails(nAppID, strAppGetRoute, strAppUsersGetRoute, strCategoriesGetRoute)
{
    // Remove the active class from all <li> elements
    $("#appList > li").each(
        function()
        {
            $(this).removeClass();
        }
    );

    clearContents("app_users");
    clearContents("app_categories");

    // Add the active class to the first <li> element
    document.getElementById(nAppID).parentNode.setAttribute("class", "active");

    $.get(
        strAppGetRoute+"/"+nAppID,
        function(mxResponse)
        {
            var objResult = JSON.parse(mxResponse);
            if(objResult)
            {
                document.getElementById("api_key").innerHTML = objResult["appkey"];
                document.getElementById("api_secret").innerHTML = objResult["appsecret"];

                document.getElementById("formForAppDetails").app_id = nAppID;
                document.getElementById("app_name").value = objResult["name"];
                document.getElementById("app_url").value = objResult["data_url"];

                $.get(
                    strAppUsersGetRoute+"/"+nAppID,
                    function(mxResponse)
                    {
                        var objResult = JSON.parse(mxResponse);
                        if(objResult["response"].length)
                        {
                            for(var mxIndex in objResult["response"])
                            {
                                var elFormInputOption = document.createElement("option");
                                elFormInputOption.setAttribute("value", objResult["response"][mxIndex]);
                                elFormInputOption.innerHTML = objResult["response"][mxIndex];

                                document.getElementById("app_users").appendChild(elFormInputOption);
                            }

                            document.getElementById("app_recommendations").app_id = nAppID;
                            document.getElementById("app_recommendations").setAttribute("type", "button");
                        }
                        else
                        {
                            document.getElementById("app_recommendations").setAttribute("type", "hidden");
                        }

                        $.get(
                            strCategoriesGetRoute+"/"+nAppID,
                            function(mxResponse)
                            {
                                var objResult = JSON.parse(mxResponse);
                                if(Object.keys(objResult["response"]).length)
                                {
                                    for(var mxIndex in objResult["response"])
                                    {
                                        var elFormListItem = document.createElement("li");

                                        var elFormListItemCheckbox = document.createElement("input");
                                        elFormListItemCheckbox.setAttribute("type", "checkbox");
                                        elFormListItemCheckbox.setAttribute("name", mxIndex);
                                        elFormListItemCheckbox.setAttribute("id", mxIndex);
                                        elFormListItemCheckbox.setAttribute("value", mxIndex);
                                        elFormListItemCheckbox.innerHTML = mxIndex;

                                        if(objResult["response"][mxIndex])
                                        {
                                            elFormListItemCheckbox.setAttribute("checked", "checked");
                                        }

                                        var elFormListItemCheckboxLabel = document.createElement("label");
                                        elFormListItemCheckboxLabel.setAttribute("for", mxIndex);
                                        elFormListItemCheckboxLabel.innerHTML = mxIndex;

                                        elFormListItem.appendChild(elFormListItemCheckbox);
                                        elFormListItem.appendChild(elFormListItemCheckboxLabel);

                                        document.getElementById("formForAppRecommendations").app_id = nAppID;
                                        document.getElementById("app_categories").appendChild(elFormListItem);
                                    }
                                }
                            }
                        );
                    }
                );
            }
        }
    );
}