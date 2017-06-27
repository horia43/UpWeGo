/**
 * Created by hstancu on 10/27/2016.
 */




//$("#fileInput").on('change', function() {
//document.getElementById("fileInput").on('change', function() {
//document.getElementById("fileInput").change( function(event) {
//var tmppath = URL.createObjectURL(event.target.files[0]);
//$("#addPhoto").fadeIn("slow").attr('src',URL.createObjectURL(event.target.files[0]));
/*    var filePath = $(this).val();
 console.log(filePath);
 document.getElementById("addPhoto").src=filePath;*/
//var tmppath = URL.createObjectURL(event.target.files[0]);
//$("#addPhoto").src=tmppath;
//var filename = $('input[type=file]').val().split('\\').pop();
//var filename = $('input[type=file]').val().replace(/C:\\fakepath\\/i, '');
//document.getElementById("addPhoto").src="https://s-media-cache-ak0.pinimg.com/originals/7a/b9/d1/7ab9d1065843c220175b59b936eb955b.jpg";
//document.getElementById("addPhoto").src=tmppath;
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

    $(".to_home").click(function () {
        location.href='/UpWeGo/admin';
    });
    $(".log_out").click(function () {
        logout();
    });
    function logout() {
        alert("aia apasat");

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
                $('#addPhoto').attr('src', e.target.result);
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
