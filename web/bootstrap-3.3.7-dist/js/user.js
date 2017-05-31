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
function bar () {
    alert(JSON.stringify(jsonData));
    jsonData = "assign new string";
    alert(jsonData);
}
$(document).ready(function () {
    //alert(JSON.stringify(jsonData));
    //alert(jsonData[0]['payment_id']);

    var chartValues=jsonData;
    for (var i = 0; i < chartValues.length; i++) {      // eliminare payment_id din json
        delete chartValues[i].payment_id;
    };

    chartValues.sort(function(a, b) {                   //sortare in functie de data
        return a.s_date > b.s_date;
    });
    chartValues.sort();


    alert(JSON.stringify(chartValues));                 // testare / vizualizare json


    $("#yearPicker").change( function() {
        changeChart();
    });

    function changeChart(){
        //var message=$('.error'); // ca sa nu scriu tot timpul $('.error')

        //alert(base_url+"user/index");

        $.ajax({
            url:$('#form2').attr("action"), // pun " , " intre elementele trimise / parametrii
            data:$('#form2').serializeArray(),    // data=  ce trimit eu la script ( php )
            dataType: 'json',
            success:function(response){    //success e un event care se executa cand request-ul catre php s-a terminat cu succes


                if(response.success)
                {
                    //alert("S-au intors datele");
                    alert(JSON.stringify(jsonData));
                }else{
                    alert("There was a problem requesting the change");
                }
            },

            type:'POST'
        });
    }



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
        "dataProvider": chartValues,
        "graphs": [{
            "fillAlphas": 0.9,
            "lineAlpha": 0.2,
            "type": "column",
            "valueField": "s_amount"
        }],
        "categoryField": "s_date",
        "valueAxes": [{
            "title": "A very long axis title that does not fit the chart height, and needs to be truncated."
        }]
    });



    /*var chart = AmCharts.makeChart("chartdiv", {
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
    });*/
});