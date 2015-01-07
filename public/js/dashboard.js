/**
 * Created by gabriel on 16/12/14.
 */
function renderTable(strParentID, arrColumnNames, arrData)
{
    var elParent = document.getElementById(strParentID);
    while (elParent.firstChild)
    {
        elParent.removeChild(elParent.firstChild);
    }

    var elRecommendationTable = document.createElement("table");
    elRecommendationTable.setAttribute("class", "table table-striped");

    var elRecommendationTableHead = document.createElement("thead");

    var elRecommendationTableHeadRow = document.createElement("tr");
    for(var nIndex in arrColumnNames)
    {
        var elRecommendationTableHeadRowColumn = document.createElement("th");
        elRecommendationTableHeadRowColumn.innerHTML = arrColumnNames[nIndex];

        elRecommendationTableHeadRow.appendChild(elRecommendationTableHeadRowColumn);
    }

    var elRecommendationTableBody = document.createElement("tbody");
    for(var arrRow in arrData)
    {
        var elRecommendationTableBodyRow = document.createElement("tr");

        var elProductID = document.createElement("td");
        elProductID.innerHTML = arrData[arrRow]["item_id"];

        var elProductCategory = document.createElement("td");
        elProductCategory.innerHTML = arrData[arrRow]["category"];

        elRecommendationTableBodyRow.appendChild(elProductID);
        elRecommendationTableBodyRow.appendChild(elProductCategory);

        elRecommendationTableBody.appendChild(elRecommendationTableBodyRow);
    }

    elRecommendationTableHead.appendChild(elRecommendationTableHeadRow);

    elRecommendationTable.appendChild(elRecommendationTableHead);
    elRecommendationTable.appendChild(elRecommendationTableBody);

    elParent.appendChild(elRecommendationTable);
}

function clearContents(mxParentID)
{
    var elAppDetails = document.getElementById(mxParentID);
    while (elAppDetails.firstChild)
    {
        elAppDetails.removeChild(elAppDetails.firstChild);
    }

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
    clearContents("app_recommendation_list");

    // Add the active class to the first <li> element
    document.getElementById(nAppID).parentNode.setAttribute("class", "active");

    $.get(
        strAppGetRoute+"/"+nAppID,
        function(mxResponse)
        {
            var objResult = JSON.parse(mxResponse);
            if(objResult)
            {
                document.getElementById("api_key").innerHTML = objResult["id"];
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


function generateFormURL(mxFormReference)
{
    document.getElementById(mxFormReference.id).action = mxFormReference.action+"/"+mxFormReference.app_id;
}

function getAppRecommendations(strAppRecommendationURL)
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

    strAppRecommendationURL = strAppRecommendationURL+"/"+nAppID+"/"+strUser+"/"+arrSelectedCheckboxes;

    $.get(
        strAppRecommendationURL,
        function(mxResponse)
        {
            var objResponse = JSON.parse(mxResponse);
            if(Object.keys(objResponse["response"]).length)
            {
                var arrTableColumns = ["Item ID", "Category"];

                renderTable("app_recommendation_list", arrTableColumns, objResponse["response"]);
            }
        }
    );
}