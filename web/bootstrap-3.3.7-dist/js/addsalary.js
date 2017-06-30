/**
 * Created by Stancu on 3/10/2017.
 */

function chooseFile() {
    document.getElementById("fileInput").click();
}
/*$(document).bind("contextmenu",function(e) {
 e.preventDefault();
 });
 $(document).keydown(function(e){
 if(e.which === 123){
 return false;
 }
 });*/

function divshow(url_name, backup_name) {

    document.getElementById("divPicture2").style.backgroundImage = "url('" + url_name + "'),url('" + backup_name + "')";
    document.getElementById("divPicture2").style.backgroundRepeat = "no-repeat";
    document.getElementById("divPicture2").style.backgroundPosition = "center center";
    document.getElementById("divPicture2").style.backgroundSize = "cover";
    //document.getElementById("divPicture").style.background="#ffffff url('" +url_name +"') no-repeat center";


    $('#viewprofilepic2').modal();
}
// Select your input element.
var number = document.getElementById('s_amount');

// Listen for input event on numInput.
number.onkeydown = function(e) {
    if(!((e.keyCode > 95 && e.keyCode < 106)
        || (e.keyCode > 47 && e.keyCode < 58)
        || e.keyCode == 8)) {
        return false;
    }
}


$(document).ready(function () {
    $(".to_home2").click(function () {
        location.href='/UpWeGo/admin';
    });
    $(".log_out2").click(function () {
        logout();
    });
    function logout() {
        $.ajax({
            url: base_url + "login/logout",
            dataType: 'json',
            success: function (response) {
                if(response.success){
                    location.href = "/UpWeGo";
                }else{
                    alert("Ceva nu a mers bine, inapoi la login");
                    location.href = "/UpWeGo";
                }
            },
            type: 'POST'
        });
    }

    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#changePhoto').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#fileInput").change(function () {
        readURL(this);
        var filename = $('#fileInput').val();
        var filename = filename.replace(/^.*\\/, "");
        //var filename = document.getElementById("fileInput").files[0];
        //$('#fileInputName').html(filename);
        document.getElementById("fileInputName").value=filename;
    });




});
