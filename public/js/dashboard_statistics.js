/**
 * Created by gabriel on 06/02/15.
 */

// Callback that creates and populates a data table,
// instantiates the pie chart, passes in the data and
// draws it.
function drawAccessChart(arrData, strContainerID)
{
    var data = google.visualization.arrayToDataTable(arrData);
    var view = new google.visualization.DataView(data);

    /*var options = {
        title: 'Company Performance',
        tooltip: {isHtml: false},
        legend: 'none'
    };*/

    var options = {
        title: 'Requested preferences',
        hAxis: {title: 'Year',  titleTextStyle: {color: '#333'}},
        vAxis: {minValue: 0}
    };

    var chart = new google.visualization.AreaChart(document.getElementById(strContainerID));

    chart.draw(view, options);

}

function getAppStatisticsByAccess(strAppStatisticsRoute, nAppID, strContainerID)
{
    $.get(
        strAppStatisticsRoute+"/"+nAppID,
        function(mxResponse)
        {
            var arrData = JSON.parse(mxResponse);

            // Load the Visualization API and the piechart package.
            google.load(
                "visualization",
                "1",
                {
                    packages:["corechart"],
                    callback:function()
                    {
                        drawAccessChart(arrData, strContainerID);
                    }
                }
            );
        }
    );
}

function drawPreferenceChart(arrData, strContainerID)
{
    var data = google.visualization.arrayToDataTable(arrData);
    var view = new google.visualization.DataView(data);

    /*var options = {
     title: 'Company Performance',
     tooltip: {isHtml: false},
     legend: 'none'
     };*/

    var options = {
        title: 'Collected preferences',
        hAxis: {title: 'Year',  titleTextStyle: {color: '#333'}},
        vAxis: {minValue: 0}
    };

    var chart = new google.visualization.AreaChart(document.getElementById(strContainerID));

    chart.draw(view, options);

}

function getAppStatisticsByPreference(strAppStatisticsRoute, nAppID, strContainerID)
{
    $.get(
        strAppStatisticsRoute+"/"+nAppID,
        function(mxResponse)
        {
            var arrData = JSON.parse(mxResponse);

            // Load the Visualization API and the piechart package.
            google.load(
                "visualization",
                "1",
                {
                    packages:["corechart"],
                    callback:function()
                    {
                        drawPreferenceChart(arrData, strContainerID);
                    }
                }
            );
        }
    );
}