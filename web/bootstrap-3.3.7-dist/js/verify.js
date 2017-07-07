/**
 * Created by Stancu on 6/17/2017.
 */


$(document).ready(function () {

    $("#btn_activate").click(function () {
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
            url: base_url + "login/verify",

            data: $('#form1').serializeArray(),    // data=  ce trimit eu la script ( php )
            dataType: 'json',
            success: function (response) {    //success e un event care se executa cand request-ul catre php s-a terminat cu succes
                //console.log(response);     // rezultatul a ceea ce face output scriptul de php
                if (response.success) {
                    alert(response.msg);
                    $("#active_msg").empty();
                    var active_msg = document.getElementById("active_msg");

                    var divElement = document.createElement('div');
                    divElement.className = 'statusmsg_yes';
                    divElement.innerHTML=response.msg;
                    active_msg.appendChild(divElement);

                    //var div='<div class="statusmsg_yes">' + response.msg + '</div>';
                    //document.body.innerHTML+=div;
                    window.setTimeout(function () {
                        location.href = "/UpWeGo";
                    }, 5000);
                    /*if (response.isAdmin) {
                        //window.location.href = "welcome/createSession";
                        window.location.href = "admin";
                        /!*window.location.href = "http://localhost/ex1/2.html";*!/
                        /!*window.location.href = "http://localhost/ex1/2.html";*!/
                    } else {
                        //window.location.href = "welcome/createSession";
                        //window.location.href = "admin";
                        window.location.href = "user";
                    }*/
                } else {


                    //alert(response.msg);
                    //location.reload();
                    $("#active_msg").empty();
                    var active_msg = document.getElementById("active_msg");

                    var divElement = document.createElement('div');
                    divElement.className = 'statusmsg_no';
                    //document.getElementById('results').innerHTML
                    divElement.innerHTML=response.msg;
                    active_msg.appendChild(divElement);

                    //var div='<div class="statusmsg_no">' + response.msg + '</div>';
                    //document.body.innerHTML+=div;
                    //document.getElementsByTagName("input")[1].value = '';
                    // var username = document.getElementsByTagName("input")[0].value;
                    // window.location.href = "welcome";
                    // document.getElementsByTagName("input")[0].value = username;
                    //$("#form1")[0].reset();
                    //document.getElementsByClassName("userpass")[0].value='';
                    //document.getElementsByTagName("input")[1].style.border='5px dashed red';
                }
            },
            type: 'POST'
        });
    }
});