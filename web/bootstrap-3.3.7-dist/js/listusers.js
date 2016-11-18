/**
 * Created by hstancu on 11/18/2016.
 */
function divshow(url_name){

    document.getElementById("divPicture").style.backgroundImage="url('" +url_name +"')";
    document.getElementById("divPicture").style.backgroundRepeat="no-repeat";
    document.getElementById("divPicture").style.backgroundPosition="center center";
    document.getElementById("divPicture").style.backgroundSize="cover"
    //document.getElementById("divPicture").style.background="#ffffff url('" +url_name +"') no-repeat center";


    $('#viewprofilepic').modal();
}
$(document).ready(function () {



});
