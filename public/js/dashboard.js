/**
 * Created by gabriel on 16/12/14.
 */
function renderTable(strParentID, arrColumnNames, arrData)
{
    var elParent = document.getElementById(strParentID);


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


function renderForm(objFormData)
{
    //Create form element.
    var elForm = document.createElement("form");
    elForm.setAttribute("id", "formFor"+objFormData.parent_id);
    elForm.setAttribute("class", "col-sm-9 form-horizontal");
    elForm.setAttribute("method", objFormData.method);
    elForm.setAttribute("action", objFormData.action);

    //Create form inputs.
    for(var objInput in objFormData.fields)
    {
        var elContainer = document.createElement("div");
        elContainer.setAttribute("class", "form-group");

        var elFormInputLabel = document.createElement("label");
        elFormInputLabel.setAttribute("class", "col-sm-3 control-label");
        elFormInputLabel.innerHTML = objFormData.fields[objInput].label;

        var elFormInputContainer = document.createElement("div");
        elFormInputContainer.setAttribute("class", "col-sm-6");

        //Separate behaviour for select inputs.
        if(objFormData.fields[objInput].type == "select")
        {
            var elFormInput = document.createElement("select");
            elFormInput.setAttribute("form", elForm.id);
            elFormInput.setAttribute("class", "form-control");

            for(var nIndex in objFormData.fields[objInput]["values"])
            {
                var elFormInputOption = document.createElement("option");
                elFormInputOption.setAttribute("value", objFormData.fields[objInput]["values"][nIndex]);
                elFormInputOption.innerHTML = objFormData.fields[objInput]["values"][nIndex];

                elFormInput.appendChild(elFormInputOption);
            }
        }
        else if(objFormData.fields[objInput].type == "checkbox")
        {
            var elFormInput = document.createElement("ul");
            elFormInput.setAttribute("class", "list-unstyled");

            for(var mxIndex in objFormData.fields[objInput]["values"])
            {
                var elFormInputItem = document.createElement("li");

                var elFormInputCheckbox = document.createElement("input");
                elFormInputCheckbox.setAttribute("type", objFormData.fields[objInput].type);
                elFormInputCheckbox.setAttribute("name", mxIndex);
                elFormInputCheckbox.setAttribute("id", mxIndex);
                elFormInputCheckbox.setAttribute("value", mxIndex);
                elFormInputCheckbox.innerHTML = mxIndex;

                if(objFormData.fields[objInput]["values"][mxIndex])
                {
                    elFormInputCheckbox.setAttribute("checked", "checked");
                }

                var elFormInputCheckboxLabel = document.createElement("label");
                elFormInputCheckboxLabel.setAttribute("for", mxIndex);
                elFormInputCheckboxLabel.innerHTML = mxIndex;

                elFormInputItem.appendChild(elFormInputCheckbox);
                elFormInputItem.appendChild(elFormInputCheckboxLabel);

                elFormInput.appendChild(elFormInputItem);
            }
        }
        else
        {
            var elFormInput = document.createElement("input");
            elFormInput.setAttribute("type", objFormData.fields[objInput].type);
            elFormInput.setAttribute("name", objFormData.fields[objInput].name);
            elFormInput.setAttribute("value", objFormData.fields[objInput].value);
            elFormInput.setAttribute("class", "form-control");
            elFormInput.setAttribute("required", "required");
            elFormInput.setAttribute("aria-required", "true");
        }

        elFormInputContainer.appendChild(elFormInput);
        elContainer.appendChild(elFormInputLabel);
        elContainer.appendChild(elFormInputContainer);
        elForm.appendChild(elContainer);
    }

    if(objFormData.hasOwnProperty("submitText") && objFormData.submitText.length)
    {
        var elSubmitButtonContainer = document.createElement("div");
        elSubmitButtonContainer.setAttribute("class", "col-sm-9 modal-footer");


        var elSubmitButton = document.createElement("input");
        elSubmitButton.setAttribute("type", "submit");
        elSubmitButton.setAttribute("value", objFormData.submitText);
        elSubmitButton.setAttribute("class", "btn btn-success");

        elSubmitButtonContainer.appendChild(elSubmitButton);
    }

    // If the method and action properties are not defined then an AJAX call is made instead of form submission.
    if(objFormData.hasOwnProperty("ajaxButton") && objFormData.ajaxButton.length)
    {
        var elAjaxButton = document.createElement("input");
        elAjaxButton.setAttribute("type", "button");
        elAjaxButton.setAttribute("value", objFormData.ajaxButton);
        elAjaxButton.setAttribute("class", "btn btn-success");

        elSubmitButtonContainer.appendChild(elAjaxButton);

        if (objFormData.ajax_url.length)
        {
            elAjaxButton.addEventListener(
                "click",
                function ()
                {
                    var arrFormInputs = $("#" + objFormData.parent_id + " :input");
                    var strInitialURL = objFormData.ajax_url;
                    var arrCheckboxValues = [];
                    var bInvalidInput = false;

                    for (var elInput in arrFormInputs)
                    {
                        //Check only input fields that are not used for submission or AJAX calls ( fields completed by the user ).
                        if (
                            arrFormInputs[elInput].type != "submit"
                            && arrFormInputs[elInput].type != "button"
                            && arrFormInputs[elInput].hasOwnProperty("value")
                        )
                        {
                            //If by some chance an input is left empty mark the URL for the ajax call as invalid.
                            //This is done because the URL is completed with information from every field and if one field is not completed then
                            //The final URL would be invalid.
                            if (!arrFormInputs[elInput].value.length)
                            {
                                bInvalidInput = true;
                            }
                            else
                            {
                                if (arrFormInputs[elInput].type != "checkbox")
                                {
                                    objFormData.ajax_url = objFormData.ajax_url + "/" + arrFormInputs[elInput].value;
                                }
                                else if (arrFormInputs[elInput].checked)
                                {
                                    arrCheckboxValues.push(arrFormInputs[elInput].value);
                                }
                            }
                        }
                    }

                    if (arrCheckboxValues.length)
                    {
                        objFormData.ajax_url = objFormData.ajax_url + "/" + arrCheckboxValues;
                    }

                    if (!bInvalidInput)
                    {
                        $.get(
                            objFormData.ajax_url,
                            function (mxResponse)
                            {
                                //Clear is needed here because the page is not refreshed when clicking the button with the "click" event listener added.
                                clearForm(objFormData.ajax_result_container_id);

                                var objResponse = JSON.parse(mxResponse);

                                //If the call returns than generate a table that holds the information.
                                if (objResponse["response"])
                                {
                                    //Calling the function specified in the objFormData's ajax_callback property.
                                    objFormData.ajax_callback.call(
                                        this,
                                        objFormData.ajax_result_container_id,
                                        objFormData.ajax_callback_params,
                                        objResponse["response"]
                                    );
                                }

                                objFormData.ajax_url = strInitialURL;
                            }
                        );
                    }
                    else
                    {
                        objFormData.ajax_url = strInitialURL;
                    }
                },
                false
            );
        }
    }

    elForm.appendChild(elSubmitButtonContainer);

    document.getElementById(objFormData.parent_id).appendChild(elForm);
}


function clearForm(mxParentID)
{
    var elAppDetails = document.getElementById(mxParentID);
    while (elAppDetails.firstChild)
    {
        elAppDetails.removeChild(elAppDetails.firstChild);
    }

}


function getAppDetails(nAppID, strAppGetRoute, strAppEditRoute, strAppRecommendationsRoute, strAppUsersRoute, strCategoriesRoute, strAppCateoriesEditRoute)
{
    // Remove the active class from all <li> elements
    $("#appList > li").each(
        function()
        {
            $(this).removeClass();
        }
    );

    // Add the active class to the first <li> element
    document.getElementById(nAppID).parentNode.setAttribute("class", "active");


    $.get(
        strAppGetRoute+"/"+nAppID,
        function(mxResponse)
        {
            var objResult = JSON.parse(mxResponse);
            if(objResult.length)
            {
                // Remove previous rendered form
                clearForm("appDetails");
                clearForm("appRecommendations");
                clearForm("recommendationList");

                var objFormAppData = {};
                objFormAppData.parent_id = "appDetails";
                objFormAppData.method = "POST";
                objFormAppData.action = strAppEditRoute+"/"+nAppID;

                objFormAppData.fields = [];
                objFormAppData.fields.push(
                    {
                        "label": "App name",
                        "type": "text",
                        "name": "name",
                        "value": objResult[0]["name"].replace(/['"]+/g, '')
                    }
                );
                objFormAppData.fields.push(
                    {
                        "label": "App data URL",
                        "type": "url",
                        "name": "data_url",
                        "value": objResult[0]["data_url"].replace(/['"]+/g, '')
                    }
                );

                objFormAppData.submitText = "Save";

                renderForm(objFormAppData);



                // Add recommendation form only if the URL that returns the existing categories can be accessed.
                var objFormAppRecommendations = {};
                objFormAppRecommendations.parent_id = "appRecommendations";
                objFormAppRecommendations.method = "POST";
                objFormAppRecommendations.action = strAppCateoriesEditRoute+"/"+nAppID;

                objFormAppRecommendations.ajax_url = strAppRecommendationsRoute+"/"+nAppID;
                objFormAppRecommendations.ajax_result_container_id = "recommendationList";

                objFormAppRecommendations.ajax_callback = renderTable;
                objFormAppRecommendations.ajax_callback_params = [
                    "Item ID",
                    "Category",
                ];

                objFormAppRecommendations.fields = [];

                $.get(
                    strAppUsersRoute+"/"+nAppID,
                    function(mxResponse)
                    {
                        var objResponse = JSON.parse(mxResponse);
                        if(objResponse["response"])
                        {
                            objFormAppRecommendations.fields.push(
                                {
                                    "label": "User",
                                    "type": "select",
                                    "name": "user_id",
                                    "values": objResponse["response"]
                                }
                            );

                            objFormAppRecommendations.submitText = "Save";

                            if(objResponse["response"].length)
                                objFormAppRecommendations.ajaxButton = "Get";

                            $.get(
                                strCategoriesRoute+"/"+nAppID,
                                function(mxResponse)
                                {
                                    var objResponse = JSON.parse(mxResponse);
                                    if(objResponse["response"])
                                    {
                                        objFormAppRecommendations.fields.push(
                                            {
                                                "label": "Categories",
                                                "type": "checkbox",
                                                "name": "categories",
                                                "values": objResponse["response"]
                                            }
                                        );

                                        renderForm(objFormAppRecommendations);
                                    }
                                }
                            );
                        }
                    }
                );
            }
        }
    );
}
