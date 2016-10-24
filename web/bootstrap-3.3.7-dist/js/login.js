/**
 * Created by hstancu on 10/17/2016.
 */
$(document).ready(function () {
    // $("#form1").on('input', function() {
    // submitAction();
    // });
    //$("#form1").change( function() {
    $("#btn1").click(function () {
        submitAction();

    });

    function submitAction() {
        $.ajax({
            url: $('#form1').attr("action"),

            data: $('#form1').serializeArray(),    // data=  ce trimit eu la script ( php )
            dataType: 'json',
            success: function (response) {    //success e un event care se executa cand request-ul catre php s-a terminat cu succes
                //console.log(response);     // rezultatul a ceea ce face output scriptul de php
                if (response.success) {
                    alert("REDIRECTING TO NEXT PAGE");
                    if (response.isAdmin) {
                        window.location.href = "welcome/tralala";
                    } else {
                        window.location.href = "http://localhost/ex1/2.html";
                    }
                    //window.location.href = "welcome/tralala";
                    //window.location.href = "http://localhost/ex1/2.html";

                } else {
                    alert(response.msg);
                    document.getElementsByTagName("input")[1].value = '';

                    //$("#form1")[0].reset();
                    //document.getElementsByClassName("userpass")[0].value='';
                    //document.getElementsByTagName("input")[1].style.border='5px dashed red';
                }
            },
            type: 'POST'
        });
    }
});
