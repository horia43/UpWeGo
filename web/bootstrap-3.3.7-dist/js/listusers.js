/**
 * Created by hstancu on 11/18/2016.
 */
function divshow(url_name,backup_name){

    document.getElementById("divPicture").style.backgroundImage="url('" +url_name +"'),url('"+backup_name +"')";
    document.getElementById("divPicture").style.backgroundRepeat="no-repeat";
    document.getElementById("divPicture").style.backgroundPosition="center center";
    document.getElementById("divPicture").style.backgroundSize="cover"
    //document.getElementById("divPicture").style.background="#ffffff url('" +url_name +"') no-repeat center";


    $('#viewprofilepic').modal();
}
function pageExists(page) {
    var field = page;
    var url = window.location.href;
    if (url.indexOf('?' + field + '=') != -1)
        return true;
    else if (url.indexOf('&' + field + '=') != -1)
        return true;
    return false;
}



/*function findGetParameter(parameterName) {
    var result = null,
        tmp = [];
    var items = location.search.substr(1).split("&");
    for (var index = 0; index < items.length; index++) {
        tmp = items[index].split("=");
        if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
    }
    return result;
}*/
function findGetParameter(parameterName) {
    var result = null,
        tmp = [];
    location.search
        .substr(1)
        .split("?")
        .forEach(function (item) {
            tmp = item.split("=");
            if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
        });
    return result;
}


$(document).ready(function(){
    //    $("#list-<?php /*echo $_GET["page"];*/ ?> a").css("background-color","pink");
    //$("#list-<?php echo $_GET["page"]; ?>").addClass("active");


    if (pageExists("page")==false) {
        $("#list-1").addClass("active");
    }

    $("#list-"+findGetParameter("page")).addClass("active");



    $("#goto_page").on('keyup', function (e) {
        if (e.keyCode == 13) {
            //var page= $("#goto_page").val();
            var page= document.getElementById('goto_page').value;
            //var max = $("#pageCount").val();
            var max = document.getElementById('pageCount').value;
            if(page.match(/^\d+$/)) {
                page=parseInt(page);
                max=parseInt(max);

                if(page>max){

                    if (pageExists("page")==true) {
                        var go = "pageindex?page=" + max;    // cum de nu trebuie sa scriu si admin/pagein.... ?
                        window.location.href = go;
                    }
                    else {
                        var go = "admin/pageindex?page=" + max;    // cum de nu trebuie sa scriu si admin/pagein.... ?
                        window.location.href = go;
                    }
                }
                else
                {
                    if (pageExists("page")==true) {
                        var go = "pageindex?page=" + page;    // cum de nu trebuie sa scriu si admin/pagein.... ?
                        window.location.href = go;
                    }
                    else {
                        var go = "admin/pageindex?page=" + page;    // cum de nu trebuie sa scriu si admin/pagein.... ?
                        window.location.href = go;
                    }

                }
            }
            else
            {
                alert('Cannot send to this page! Please use only numbers.');
            }

        }
    });


});
