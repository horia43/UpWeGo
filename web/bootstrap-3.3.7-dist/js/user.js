/**
 * Created by Stancu on 3/29/2017.
 */


/*
 $(function(){
 $.ajax({
 url: 'http://localhost/chart_data.php',
 type: 'GET',
 success : function(data) {
 chartData = data;
 var chartProperties = {
 "caption": "Top 10 wicket takes ODI Cricket in 2015",
 "xAxisName": "Player",
 "yAxisName": "Wickets Taken",
 "rotatevalues": "1",
 "theme": "zune"
 };
 apiChart = new FusionCharts({
 type: 'column2d',
 renderAt: 'chart-container',
 width: '550',
 height: '350',
 dataFormat: 'json',
 dataSource: {
 "chart": chartProperties,
 "data": chartData
 }
 });
 apiChart.render();
 }
 });
 });
 */


/**
 * Plugin to auto-truncate the axis labels
 */
$(document).ready(function () {
    AmCharts.addInitHandler(function (chart) {

        // Add handler for when the chart is inited
        chart.addListener("init", function (e) {

            // Process each value axis
            for (var i = 0; i < chart.valueAxes.length; i++) {
                var axis = chart.valueAxes[i];
                if (axis.title) {

                    // Get available height
                    var ph = chart.plotAreaHeight;

                    // Calculate title actual height
                    var th = axis.titleLabel.node.clientWidth;
                    if (th > ph) {

                        // Preserve original title
                        axis.originalTitle = axis.title;

                        // Start truncating the title
                        while (th > ph) {
                            if (axis.title.match(/[\W]+/)) {
                                // Truncate a word
                                axis.title = axis.title.replace(/[\W]?[\w]*$/, "");
                            } else {
                                // Truncate a character
                                axis.title = axis.title.replace(/[\w]{1}$/, "");
                            }
                            axis.titleLabel.node.firstElementChild.innerHTML = axis.title + "...";
                            th = axis.titleLabel.node.clientWidth;
                        }

                        // Set up hover balloon
                        var title = document.createElementNS("http://www.w3.org/2000/svg", "title");
                        title.textContent = axis.originalTitle;
                        axis.titleLabel.node.appendChild(title);


                    }
                }
            }
        });
    }, ["serial"]);

    /**
     * Create the chart
     */

    var chart = AmCharts.makeChart("chartdiv", {
        "type": "serial",
        "theme": "light",
        "dataProvider": [{
            "country": "USA",
            "visits": 2025
        }, {
            "country": "China",
            "visits": 1882
        }, {
            "country": "Japan",
            "visits": 1809
        }, {
            "country": "Germany",
            "visits": 1322
        }, {
            "country": "UK",
            "visits": 1122
        }, {
            "country": "Netherlands",
            "visits": 665
        }, {
            "country": "Russia",
            "visits": 580
        }, {
            "country": "South Korea",
            "visits": 443
        }, {
            "country": "Canada",
            "visits": 441
        }, {
            "country": "Brazil",
            "visits": 395
        }],
        "graphs": [{
            "fillAlphas": 0.9,
            "lineAlpha": 0.2,
            "type": "column",
            "valueField": "visits"
        }],
        "categoryField": "country",
        "valueAxes": [{
            "title": "A very long axis title that does not fit the chart height, and needs to be truncated."
        }]
    });
});