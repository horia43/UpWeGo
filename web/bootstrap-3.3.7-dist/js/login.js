/**
 * Created by hstancu on 10/17/2016.
 */
$(document).ready(function(){
    // $("#form1").on('input', function() {
    // submitAction();
    // });
    //$("#form1").change( function() {
    $("#btn1").click( function() {
        submitAction();

    });

    function submitAction(){
/*        var base_url = "<?php echo base_url();?>";
        var base_url = window.location.origin;*/
        $.ajax({
            // url:base_url+"application/controllers/logincontroller.php", // pun " , " intre elementele trimise / parametrii
            url: '<?php echo base_url()?>application/controllers/logincontroller.php',
            data:$('#form1').serializeArray(),    // data=  ce trimit eu la script ( php )
            dataType: 'json',
            success:function(response){    //success e un event care se executa cand request-ul catre php s-a terminat cu succes
                //console.log(response);     // rezultatul a ceea ce face output scriptul de php
                if(response.success)
                {
                    alert("OK");

                }else{
                    alert(response.msg);
                }
            },
            type:'POST'
        });
    }
});
