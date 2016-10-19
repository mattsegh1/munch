/* Author: Matthias Seghers
 *
 * Created: 30/03/2016
 * Modified: 01/08/2016
 *
 * @TODO: More colors
 * @TODO: Pie Chart
 *
 * Allows easy access to dynamically create graphs with the Chart.js framework
 * Requirements: loDash, jQuery, ChartJS */

$(document).ready(function () {

    if (typeof chartData !== 'undefined') {
        //Structure 2
        var dataPie = [
            {
                value: 200,
                color: "#F7464A",
                highlight: "#FF5A5E",
                label: "Red"
            },
            {
                value: 50,
                color: "#46BFBD",
                highlight: "#5AD3D1",
                label: "Green"
            },
            {
                value: 100,
                color: "#FDB45C",
                highlight: "#FFC870",
                label: "Yellow"
            },
            {
                value: 40,
                color: "#949FB1",
                highlight: "#A8B3C5",
                label: "Grey"
            },
            {
                value: 120,
                color: "#4D5360",
                highlight: "#616774",
                label: "Dark Grey"
            }
        ];

        //var labels = ["Januari", "Februari", "Maart", "April", "Mei", "Juni", "Juli", "Augustus", "September", "Oktober", "november", "December"];
        var labels = [];
        for (var i = 0; i < chartData.timeStamps.length; i++)
        {
            var date = Date.createFromMysql(chartData.timeStamps[i]);
            labels.push(date.getDate()  + "-" + (date.getMonth() + 1)+ "-" + date.getFullYear());
        }
        console.log(chartData);
        var datasets = [
            {
                label: "Prijs",
                data: chartData.priceHistory,
            },
            {
                label: "Voorraad",
                data: chartData.stockHistory,
            },
        ];

        drawGraph('lineChart', "line", datasets, labels);
    }
});


function drawGraph(elementID, graphType, dataSets, labels) {
    var graphTypes = ["line", "bar", "radar"];


    if (graphTypes.includes(graphType)) {
        //RGB
        var colors = [
            "139, 195, 74",//Light Green
            "33, 150, 243", //Blue
            "244, 67, 54", //Red
            "158, 158, 158",//Grey
        ];


        if (labels.constructor !== Array) {
            console.log("Labels are not in the right format. Needs to be an array!");
            return;
        }
        else {
            if(labels.length == 0)
            {
                var nDataSets = dataSets.length;
                var nData = 0;
                for(var x = 0; x < nDataSets; x++)
                {
                    if(dataSets[x].data.length > nData)
                    {
                        nData = dataSets[x].data.length;
                    };
                }
                for (var y = 0; y < nData; y++)
                {
                    labels.push(y);
                }

            }
            //Setting Data
            var data = {
                labels: labels,
                datasets: dataSets,
            };

            //Setting colors
            for (var i = 0; i < data.datasets.length; i++) {
                data.datasets[i].fillColor = "rgba(" + colors[i] + ",0.2)";
                data.datasets[i].strokeColor = "rgba(" + colors[i] + ",1)";
                data.datasets[i].pointColor = "rgba(" + colors[i] + ",1)";
                data.datasets[i].pointStrokeColor = "#fff";
                data.datasets[i].pointHighlightFill = "#fff";
                data.datasets[i].pointHighlightStroke = "rgba(" + colors[i] + ",1)";

            }

            //Getting canvas
            var ctx = document.getElementById(elementID).getContext("2d");


            //Drawing on the canvas
            var myLineChart = new Chart(ctx).Line(data, {
                responsive: true,
                animation: true,
                multiTooltipTemplate: "<%= datasetLabel %> - <%= value %>"
            });
            console.log(data);
        }
    }
}

Date.createFromMysql = function(mysql_string)
{
    var t, result = null;

    if( typeof mysql_string === 'string' )
    {
        t = mysql_string.split(/[- :]/);

        //when t[3], t[4] and t[5] are missing they defaults to zero
        result = new Date(t[0], t[1] - 1, t[2], t[3] || 0, t[4] || 0, t[5] || 0);
    }

    return result;
}