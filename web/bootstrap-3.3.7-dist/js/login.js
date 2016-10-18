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
        //var url = "topoftable()";
        //var base_url = '<?php echo base_url();?>';
        //base_url+='/application/controllers/login.php';
        //alert(base_url);
        //var a='<?php echo site_url('application/controllers/login.php')?>';
        $.ajax({
            // url:base_url+"application/controllers/login.php", // pun " , " intre elementele trimise / parametrii
            url: 'loginvalidation',
            //url: '<?php echo base_url("index.php/application/controllers/login.php");?>',
            //url: 'application/controllers/login.php',
            //url: url,
            //url: base_url,

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
