/**
 * Created by hstancu on 11/18/2016.
 */
function divshow(url_name, backup_name) {

    document.getElementById("divPicture").style.backgroundImage = "url('" + url_name + "'),url('" + backup_name + "')";
    document.getElementById("divPicture").style.backgroundRepeat = "no-repeat";
    document.getElementById("divPicture").style.backgroundPosition = "center center";
    document.getElementById("divPicture").style.backgroundSize = "cover"
    //document.getElementById("divPicture").style.background="#ffffff url('" +url_name +"') no-repeat center";


    $('#viewprofilepic').modal();
}
function parameterExists(page) {
    var field = page;
    var url = window.location.href;
    if (url.indexOf('?' + field + '=') != -1)
        return true;
    else if (url.indexOf('&' + field + '=') != -1)
        return true;
    return false;
}


function findGetParameter(parameterName) {
    var result = null,
        tmp = [];
    var items = location.search.substr(1).split("&");
    for (var index = 0; index < items.length; index++) {
        tmp = items[index].split("=");
        if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
    }
    return result;
}
/*function findGetParameter(parameterName) {
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
 }*/


$(document).ready(function () {


/*    if($('#field').is(':disabled')){
        $('#go_btn').prop('disabled', true);
    }*/
    $('#field').one('change', function() {
            $('#search').prop('disabled', false);
    });


    if (parameterExists("field") == true) {
        $('#field').val(findGetParameter("field"));
    }
    if (parameterExists("search") == true) {
        $('#search').val(findGetParameter("search"));
    }

    $('#go_btn').attr('disabled', true);

    if ($("#search")[0].value =='') {
        $('#search').attr('disabled', true);
    }else{
        $('#search').attr('disabled', false);
    }
/*    //if ($("#field ")[0].selectedIndex == 0) {
    if ($("#field")[0].value == 'filter') {
        $('#search').attr('disabled', true);
    }else{
        $('#search').attr('disabled', false);
    }*/


    $('input[name="search"]').on('keyup',function() {
        var search_value = $('input[name="search"]').val();
        if(search_value != '') {
            $('#go_btn').attr('disabled' , false);
        }else{
            $('#go_btn').attr('disabled' , true);
        }
    });




    $(".to_home").click(function () {
        location.href='/UpWeGo/admin';
    });
    $(".log_out").click(function () {
        logout();
    });


    function filterBy(){
        $.ajax({
            url: base_url + "admin/filterBy",
            data: $('#filter').serializeArray(),
            dataType: 'json',
            success: function (response) {
                if(response.success){
                    location.href = "/UpWeGo";
                }else{
                    location.href = "/UpWeGo";
                }
            },
            type: 'POST'
        });
    }


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
    /*if (parameterExists("page") == true && parseInt(findGetParameter("page")) > parseInt(document.getElementById('pageCount').textContent)) {   // only for manual changing the url
        var x=findGetParameter("page");
        alert(x.match(/^\d+$/));
        if (findGetParameter("page").match(/^\d+$/)) {
            var items = document.getElementById('rows_per_page').value;
            var max = document.getElementById('pageCount').textContent;
            max = parseInt(max);

            var go = "pageindex?page=" + max + "&items=" + items;
            window.location.href = go;
        }else{
            alert('Invalid URL'); // not working..
        }
    }*/

    if (parameterExists("page") == false) {
        $("#list-1").addClass("active");
    } else {
        $("#list-" + findGetParameter("page")).addClass("active");     //// ATENTIE ! AICI PREIA  #list-4&items in loc de 4 doar !
    }

    if (parameterExists("items") == true) {
        $('input[name=rows_per_page]').val(findGetParameter("items"));
    }



//.$_GET["field"]."&search=".$_GET["search"]
//     var field = document.getElementById('field').value;
//     var search = document.getElementById('search').value;

    $("#goto_page").on('keyup', function (e) {
        if (e.keyCode == 13) {
            var page = document.getElementById('goto_page').value;
            var items = document.getElementById('rows_per_page').value;
            var max = document.getElementById('pageCount').textContent.substring(1);

            if(parameterExists("field") == true && parameterExists("search")){
                var field=findGetParameter("field");
                var search=findGetParameter("search");
                /*alert(page);
                alert(items);
                alert(max);
                alert(field);
                alert(search);*/
                if (page.match(/^\d+$/) && parseInt(page)>0) {
                    page = parseInt(page);
                    max = parseInt(max);

                    if (page > max) {

                        if (parameterExists("page") == true) {
                            var go = "pageindex?page=" + max + "&items=" + items + "&field=" + field + "&search=" + search;    // cum de nu trebuie sa scriu si admin/pagein.... ?
                            window.location.href = go;
                        }
                        else {
                            var go = "admin/pageindex?page=" + max + "&items=" + items + "&field=" + field + "&search=" + search ;    // cum de nu trebuie sa scriu si admin/pagein.... ?
                            window.location.href = go;
                        }
                    }
                    else {
                        if (parameterExists("page") == true) {
                            var go = "pageindex?page=" + page + "&items=" + items + "&field=" + field + "&search=" + search;    // cum de nu trebuie sa scriu si admin/pagein.... ?
                            window.location.href = go;
                        }
                        else {
                            var go = "admin/pageindex?page=" + page + "&items=" + items + "&field=" + field + "&search=" + search;    // cum de nu trebuie sa scriu si admin/pagein.... ?
                            window.location.href = go;
                        }

                    }
                }
                else {
                    alert('Cannot send to this page! Please use only positive natural numbers.');
                }

            }else {

                //alert(page);
                //alert(items);
                //alert(max);
                if (page.match(/^\d+$/) && parseInt(page) > 0) {
                    page = parseInt(page);
                    max = parseInt(max);

                    if (page > max) {

                        if (parameterExists("page") == true) {
                            var go = "pageindex?page=" + max + "&items=" + items;    // cum de nu trebuie sa scriu si admin/pagein.... ?
                            window.location.href = go;
                        }
                        else {
                            var go = "admin/pageindex?page=" + max + "&items=" + items;    // cum de nu trebuie sa scriu si admin/pagein.... ?
                            window.location.href = go;
                        }
                    }
                    else {
                        if (parameterExists("page") == true) {
                            var go = "pageindex?page=" + page + "&items=" + items;    // cum de nu trebuie sa scriu si admin/pagein.... ?
                            window.location.href = go;
                        }
                        else {
                            var go = "admin/pageindex?page=" + page + "&items=" + items;    // cum de nu trebuie sa scriu si admin/pagein.... ?
                            window.location.href = go;
                        }

                    }
                }
                else {
                    alert('Cannot send to this page! Please use only positive natural numbers.');
                }
            }

        }
    });


    $("#rows_per_page").on('keyup', function (e) {
        if (e.keyCode == 13) {
            //var page= $("#goto_page").val();
            var items = $('#rows_per_page').val();

            //var max = $("#pageCount").val();
            //var max = document.getElementById('pageCount').value;

            if(parameterExists("field") == true && parameterExists("search")) {
                var field = findGetParameter("field");
                var search = findGetParameter("search");

                if (items.match(/^\d+$/) && parseInt(items) > 0) {
                    items = parseInt(items);
                    if (parameterExists("page") == false) {
                        var go = "admin/pageindex?page=1" + "&items=" + items + "&field=" + field + "&search=" + search;
                        window.location.href = go;
                    } else {
                        //var go="pageindex?page="+findGetParameter("page")+"&items="+items;
                        var go = "pageindex?page=1" + "&items=" + items + "&field=" + field + "&search=" + search;
                        window.location.href = go;
                    }
                }
                else {
                    alert('Please use only positive natural numbers.');
                }
            }else{

                if (items.match(/^\d+$/) && parseInt(items) > 0) {
                    items = parseInt(items);
                    if (parameterExists("page") == false) {
                        var go = "admin/pageindex?page=1" + "&items=" + items;
                        window.location.href = go;
                    } else {
                        //var go="pageindex?page="+findGetParameter("page")+"&items="+items;
                        var go = "pageindex?page=1" + "&items=" + items;
                        window.location.href = go;
                    }
                }
                else {
                    alert('Please use only positive natural numbers.');
                }
            }

        }
    });


});
