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
function bar() {
    alert(JSON.stringify(jsonData));
    jsonData = "assign new string";
    alert(jsonData);
}
$(document).ready(function () {
    //alert(JSON.stringify(jsonData));
    //alert(jsonData[0]['payment_id']);

    var chartValues = jsonData;
    /*for (var i = 0; i < chartValues.length; i++) {      // eliminare payment_id din json
     delete chartValues[i].payment_id;
     }

     function(obj) {
     // Get month number from date-string and then substract 1
     var monthNum = parseInt(obj.month.slice(-2)) - 1;
     // Get month name from the array
     obj.month = monthsName[monthNum];
     // Return the object
     return obj;
     }
     function sortSalaryByDate(a, b) {                   //sortare in functie de data
     if(a.s_date > b.s_date){
     return 1;
     }
     if(a.s_date < b.s_date){
     return -1;
     }
     return 0;
     }


     chartValues.sort(function (a, b) {                   //sortare in functie de data
     return a.s_date > b.s_date;
     });


     chartValues.sort();
     */
    changeChart();
    //alert(JSON.stringify(chartValues));                 // testare / vizualizare json


    $("#yearPicker").change(function () {
        changeChart();
    });

    $('#downloadPDF').click(function () {
        //download_pdf();
    });

    function changeChart() {
        //var message=$('.error'); // ca sa nu scriu tot timpul $('.error')

        //alert(base_url+"user/index");
        //alert($('#form2').attr("action"));
        $.ajax({
            url: base_url + "user/changeChart",//$('#form2').attr("action"), // pun " , " intre elementele trimise / parametrii
            data: $('#form2').serializeArray(),    // data=  ce trimit eu la script ( php )
            dataType: 'json',
            success: function (response) {    //success e un event care se executa cand request-ul catre php s-a terminat cu succes


                if (response.success) {


                    var chartValues = response.data;


                    //var json = JSON.stringify(eval("(" + response.data + ")"));
                    //var NewChartData = [];
                    //NewChartData.push(JSON.parse(response.data));
                    alert(chartValues);
                    var NewChartData = JSON.parse(chartValues);
                    //alert(NewChartData);
                    /*NewChartData.sort(function (a, b) {                   //sortare in functie de data
                     return a.s_date > b.s_date;
                     });
                     NewChartData.sort();*/


                    //alert(JSON.stringify(NewChartDataArray));

                    //Setting the new data to the graph
                    chart.dataProvider = NewChartData;

                    //Updating the graph to show the new data
                    chart.validateData();
                    //chart.animateAgain();
                    playAnimation('easeInSine', 1.5);
                    //alert(NewChartData);
                    //alert(JSON.stringify(NewChartData));

                } else {
                    alert("There was a problem requesting the change");
                    //alert(response.msg);
                }
            },

            type: 'POST'
        });
    }


    function playAnimation(effect, duration) {
        console.log("clicked animation");
        chart.startEffect = effect;
        chart.startDuration = duration;
        chart.animateAgain();
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
            "balloonText": "[[category]]: </br><b>[[value]] RON </b>",
            "fillAlphas": 0.8,
            "lineAlpha": 0.2,
            "type": "column",
            "valueField": "s_amount",
            "fillColors": "#24742F",
            "balloon": {
                "drop": true
            }
        }],
        "categoryField": "s_date",
        "valueAxes": [{
            "title": "Salaries over the year.",
            "gridColor": "#24742F",
            "gridAlpha": 1.2,
            "dashLength": 4
        }],
        "startDuration": 1,
        "chartScrollbar": {
            "autoGridCount": true,
            "graph": "g1",
            "scrollbarHeight": 50
        },
        /*        "backgroundAlpha":1,
         "backgroundColor":"#08ffb2",*/
        "categoryAxis": {
            "gridPosition": "start",
            "labelRotation": 45
        },
        "chartCursor": {
            "categoryBalloonEnabled": true,
            "cursorAlpha": 0,
            "zoomable": true,
            "limitToGraph": "g1"
        },
        "mouseWheelZoomEnabled": true
    });


    function download_pdf() {
        $.ajax({
            url: base_url + "user/downloadPDF",
            data: document.getElementsByTagName('body')[0].innerHTML,    // data=  ce trimit eu la script ( php )
            dataType: 'json',
            success: function (response) {
                alert("Hope your download will start shortly.");
            },

            type: 'POST'
        });
    }


    var bodyHtml = document.getElementsByTagName('body')[0].innerHTML;
    var clickBtnValue = $(this).val();
    var ajaxurl = 'ajax.php',
        data = {'action': clickBtnValue};
    $.post(ajaxurl, data, function (response) {
        // Response div goes here.
        alert("action performed successfully");
