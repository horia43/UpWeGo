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

    /*$("#username").keyup(function(event){
        if(event.keyCode == 13){
            $("#btn1").click();
        }
    });
    $("#password").keyup(function(event){
        if(event.keyCode == 13){
            $("#btn1").click();
        }
    });*/

    function submitAction() {
        $.ajax({
            url: $('#form1').attr("action"),

            data: $('#form1').serializeArray(),    // data=  ce trimit eu la script ( php )
            dataType: 'json',
            success: function (response) {    //success e un event care se executa cand request-ul catre php s-a terminat cu succes
                //console.log(response);     // rezultatul a ceea ce face output scriptul de php
                if (response.success) {
                    var username=$("#username").val();
                    //alert("REDIRECTING TO NEXT PAGE");
                    if (response.isAdmin) {
                        //window.location.href = "welcome/createSession";

                        $('#myForm').addClass("bounceOutRight");
                        $(function(){
                            setTimeout(function(){
                                $('.fly-in-text').removeClass('hidden');
                                $("#u_name").html(username);
                            },500);
                        });
                        $(function(){
                            setTimeout(function(){
                                $('#u_name').removeClass("hidden2");
                                $('#u_name').addClass("animated bounceInDown");
                            },2000);
                        });
                        window.setTimeout(function () {
                            location.href = "admin";
                        }, 4500);
                        //window.location.href = "admin";
                        /*window.location.href = "http://localhost/ex1/2.html";*/
                        /*window.location.href = "http://localhost/ex1/2.html";*/
                    } else {
                        //window.location.href = "welcome/createSession";
                        //window.location.href = "admin";
                        $('#myForm').addClass("bounceOutRight");
                        $(function(){
                            setTimeout(function(){
                                $('.fly-in-text').removeClass('hidden');
                                $("#u_name").html(username);
                            },500);
                        });
                        $(function(){
                            setTimeout(function(){
                                $('#u_name').removeClass("hidden2");
                                $('#u_name').addClass("animated bounceInDown");
                            },2000);
                        });
                        window.setTimeout(function () {
                            location.href = "user";
                        }, 4500);
                        //window.location.href = "user";
                    }
                } else {
                    alert(response.msg);
                    //document.getElementsByTagName("input")[1].value = '';
                    var username = document.getElementsByTagName("input")[0].value;
                    window.location.href = "welcome";
                    document.getElementsByTagName("input")[0].value = username;
                    //$("#form1")[0].reset();
                    //document.getElementsByClassName("userpass")[0].value='';
                    //document.getElementsByTagName("input")[1].style.border='5px dashed red';
                }
            },
            type: 'POST'
        });
    }
});
