/**
 * Created by gabriel on 06/02/15.
 */

// Callback that creates and populates a data table,
// instantiates the pie chart, passes in the data and
// draws it.
function drawChart(arrData)
{
    var data = google.visualization.arrayToDataTable(arrData);
    var view = new google.visualization.DataView(data);

    var options = {
        title: 'Company Performance',
        tooltip: {isHtml: false},
        legend: 'none'
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('appStatistics'));

    chart.draw(view, options);

}

function getAppStatistics(strAppStatisticsRoute, nAppID)
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
                        drawChart(arrData);
                    }
                }
            );
        }
    );
}