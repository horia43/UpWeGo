/**
 * Created by Stancu on 3/29/2017.
 */




/**
 * Plugin to auto-truncate the axis labels
 */
/*function bar() {
    alert(JSON.stringify(jsonData));
    jsonData = "assign new string";
    alert(jsonData);
}*/

$(document).ready(function () {
    //alert(JSON.stringify(jsonData));
    //alert(jsonData[0]['payment_id']);

    var chartValues;// = jsonData;
    var username=user;
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

    $('#exportCSV').click(function () {
        download_CSV();
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


                    chartValues = response.data;


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


                    //alert(JSON.stringify(NewChartData));

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
        /*"depth3D": 20,
        "angle": 30,*/
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
        "mouseWheelZoomEnabled": true,
        "listeners": [{
            "event": "clickGraphItem",
            "method": function (event) {
                //alert(event.item.category);
                //document.getElementById('downloadFlyer').click();
                //$("#downloadFlyer").trigger("click");
                var a = $("#downloadFlyer")[0];
                var x = a.href;
                a.href += "?yearPicker="+$("#yearPicker")[0].value+"&month="+event.item.category;
                $("#downloadFlyer")[0].click();
                a.href = x;

            }
        }]
    });
    function download_CSV() {
        var filename=username + "-" +$("#yearPicker")[0].value + ".csv";
        var rows =['Month','Salary'];
        //alert (chartValues);
        var NewChartData = JSON.parse(chartValues);
        var months=["Ianuarie", "Februarie", "Martie", "Aprilie", "Mai", "Iunie", "Iulie", "August","Septembrie","Octombrie","Noiembrie","Decembrie"];
        var x=[[]];
        for(var i=0; i<12; ++i){
            x[i]=[months[i],NewChartData[i]["s_amount"]];
        //    rows+='['+months[i]+','+NewChartData[i]["s_amount"]+'],';
        }
        //alert(NewChartData[0]["s_date"]);
        //var y=JSON.stringify(x);
        //alert(y);
        //alert(x[0]+x[1]+x[2]);
        //exportToCsv(filename,y);
        exportToCsv(filename, [
            rows,
            x[0],x[1],x[3],x[4],
            x[5],x[6],x[7],x[8],
            x[9],x[10],x[11]
        ])
    }
    /*function download_pdf() {
        //alert("Bravo, ai apasat acest buton !");
        $.ajax({
            url: base_url + "user/downloadPDF",
            //data: document.getElementsByTagName('body')[0].innerHTML,    // data=  ce trimit eu la script ( php )
            //data: $('#form2').serializeArray(),    // data=  ce trimit eu la script ( php )
            //dataType: 'json',
            success: function (response) {
                window.testDATA = response;
                var pdf_64 = b64EncodeUnicode(response);
                //console.log(pdf_64);
                var dataURI = "data:application/pdf;base64," +pdf_64;
                console.log(dataURI);
                window.open(dataURI);
                /!*
                if (response.success){
                    alert("Hope your download will start shortly.");
                    alert(response.data+"true");
                }
                else{
                    alert("fraier");
                    alert(response.data+"false");
                }*!/
                //alert(document.getElementsByTagName('body')[0].innerHTML);
            },

            type: 'POST'
        });
    }*/
});

function exportToCsv(filename, rows) {
    var processRow = function (row) {
        var finalVal = '';
        for (var j = 0; j < row.length; j++) {
            var innerValue = row[j] === null ? '' : row[j].toString();
            if (row[j] instanceof Date) {
                innerValue = row[j].toLocaleString();
            };
            var result = innerValue.replace(/"/g, '""');
            if (result.search(/("|,|\n)/g) >= 0)
                result = '"' + result + '"';
            if (j > 0)
                finalVal += ',';
            finalVal += result;
        }
        return finalVal + '\n';
    };

    var csvFile = '';
    for (var i = 0; i < rows.length; i++) {
        csvFile += processRow(rows[i]);
    }

    var blob = new Blob([csvFile], { type: 'text/csv;charset=utf-8;' });
    if (navigator.msSaveBlob) { // IE 10+
        navigator.msSaveBlob(blob, filename);
    } else {
        var link = document.createElement("a");
        if (link.download !== undefined) { // feature detection
            // Browsers that support HTML5 download attribute
            var url = URL.createObjectURL(blob);
            link.setAttribute("href", url);
            link.setAttribute("download", filename);
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    }
}

function b64EncodeUnicode(str) {
    // first we use encodeURIComponent to get percent-encoded UTF-8,
    // then we convert the percent encodings into raw bytes which
    // can be fed into btoa.
    return btoa(encodeURIComponent(str).replace(/%([0-9A-F]{2})/g,
        function toSolidBytes(match, p1) {
            return String.fromCharCode('0x' + p1);
        }));
}

/*

    var bodyHtml = document.getElementsByTagName('body')[0].innerHTML;
    var clickBtnValue = $(this).val();
    var ajaxurl = 'ajax.php',
        data = {'action': clickBtnValue};
    $.post(ajaxurl, data, function (response) {
        // Response div goes here.
        alert("action performed successfully");
*/
