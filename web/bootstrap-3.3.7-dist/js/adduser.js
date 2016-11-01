/**
 * Created by hstancu on 10/27/2016.
 */


function chooseFile() {
    document.getElementById("fileInput").click();
}


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
$( document ).ready(function() {
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
});
});
