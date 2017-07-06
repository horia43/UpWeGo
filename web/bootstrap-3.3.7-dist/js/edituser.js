/**
 * Created by hstancu on 10/27/2016.
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
$(document).ready(function () {

    $(".to_home2").click(function () {
        location.href='/UpWeGo/admin';
    });
    $(".log_out2").click(function () {
        logout();
    });
	$("#reset").click(function () {
        location.reload(true);
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

    var sistem_list = [
        {display: "Programator IT", value: "Programator-IT" },
        {display: "Tester", value: "Tester" },
        {display: "Manager Proiect", value: "Manager-Proiect" }];

    var priordana_list = [
        {display: "Team Leader", value: "Team-Leader" },
        {display: "Programator Java", value: "Programator-Java" },
        {display: "Programator Android", value: "Programator-Android" },
        {display: "Tester", value: "Tester" }];

    var ittech_list = [
        {display: "Manager Proiect", value: "Manager-Proiect" },
        {display: "Programator C#", value: "Programator-C#" },
        {display: "Programator Web", value: "Programator-Web" },
        {display: "Tester", value: "Tester" }];



    switch(departament){ //using switch compare selected option and populate child
        case 'SisTem':
            list2(sistem_list);
            break;
        case 'PriorDana':
            list2(priordana_list);
            break;
        case 'iT Tech':
            list2(ittech_list);
            break;
        default: //default child option is blank
            $("#child_selection").html('');
            break;
    }
    function list2(array_list)
    {
        $("#child_selection").html(""); //reset child options
        $(array_list).each(function (i) { //populate child options
            if(array_list[i].value==functie){
                $("#child_selection").append('<option value='+array_list[i].value+'" selected="selected">'+array_list[i].display+'</option>');
            }else{
                $("#child_selection").append("<option value="+array_list[i].value+">"+array_list[i].display+"</option>");
            }
        });
    }


//If parent option is changed
    $("#parent_selection").change(function() {
        var parent = $(this).val(); //get option value from parent

        switch(parent){ //using switch compare selected option and populate child
            case 'SisTem':
                list(sistem_list);
                break;
            case 'PriorDana':
                list(priordana_list);
                break;
            case 'iT Tech':
                list(ittech_list);
                break;
            default: //default child option is blank
                $("#child_selection").html('');
                break;
        }
    });

//function to populate child select box
    function list(array_list)
    {
        $("#child_selection").html(""); //reset child options
        $(array_list).each(function (i) { //populate child options
            $("#child_selection").append("<option value="+array_list[i].value+">"+array_list[i].display+"</option>");
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
