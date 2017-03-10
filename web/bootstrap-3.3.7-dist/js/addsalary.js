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
$(document).ready(function () {

    $("#datepicker").datepicker( {
        format: "mm-yyyy",
        startView: "months",
        minViewMode: "months"
    });

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
