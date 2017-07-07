<!DOCTYPE html>

<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>User details</title>
    <link rel="shortcut icon" href="https://cdn3.iconfinder.com/data/icons/rcons-user-action/32/boy-512.png">

    <link rel="stylesheet" href="<?php echo base_url(); ?>web/bootstrap-3.3.7-dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/web/bootstrap-3.3.7-dist/css/mystyle.css">

    <script type="text/javascript" src="<?php echo base_url();?>/web/bootstrap-3.3.7-dist/js/ajax.js" ></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>web/bootstrap-3.3.7-dist/js/jquery-3.1.1.min.js"></script>


    <script src="//www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="//www.amcharts.com/lib/3/serial.js"></script>
    <script src="//www.amcharts.com/lib/3/themes/light.js"></script>
    <script src="//www.amcharts.com/lib/3/themes/black.js"></script>


    <script type="text/javascript" src="<?php echo base_url();?>/web/bootstrap-3.3.7-dist/js/user.js" ></script>

    <script type="text/javascript">
        var jsonData =  <?php echo $json; ?>;
        var base_url = "<?php echo base_url();?>";
        var user="<?php echo $username;?>";
    </script>
</head>
<body>
<div id="container">
    <div>
        <div style="float:left; width:150px; height:150px; margin-left:110px; margin-top:50px; margin-right:5px; border-radius:50%; background-color:white;">
            <img id="changePhoto" onclick="chooseFile();"
                 style="object-fit:cover; width:150px; height:150px; border-radius:50%; border: 1px;"
                 src="<?php echo base_url()?>upload/<?php echo $myUser[0]['picture']; ?>"  alt="Image not found"
                 onerror="this.onerror=null;this.src='<?php echo base_url()?>/upload/noprofilepic.jpg';"/>
        </div>
        <div style="float:left; width:440px; margin-top:50px; border:1px solid darkgray;border-radius:25px; padding-top:20px; padding-left:25px; margin-left:30px; padding-bottom:10px; color:#101010;">
            <table id="table2">
                <tr>
                    <td>Nume:</td>
                    <td> <?php echo $myUser[0]['lastname']?></td>
                </tr>
                <tr>
                    <td>Prenume:</td>
                    <td> <?php echo $myUser[0]['firstname']?></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td> <?php echo $myUser[0]['email']?></td>
                </tr>
                <tr>
                    <td>Utilizator:</td>
                    <td> <?php echo $myUser[0]['username']?></td>
                </tr>
                <tr>
                    <td>Departament:</td>
                    <td> <?php echo $myUser[0]['departament']?></td>
                </tr>
                <tr>
                    <td>Functie:</td>
                    <td> <?php echo $myUser[0]['functie']?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="common" style="clear:both; top:20px; left:100px; position:relative;">
        <form id="form2" action="<?php echo site_url('user/changeChart') ?>">
            <div class="styled-select yellow rounded ">
                <select id="yearPicker" name="yearPicker" class="form-control">
                    <option>2017</option>
                    <option>2016</option>
                    <option>2015</option>
                    <option>2014</option>
                </select>
            </div>

        </form>
        <button type="button" id="exportCSV" name="exportCSV" class="btn btn-warning" style="outline:0; margin-bottom:20px;">Exportare fisier CSV</button>

        <a id="downloadFlyer" href="<?php base_url();?>user/downloadPDF" class="btn btn-danger" target="_blank" style="visibility: hidden;" download> <!--download="awsomeeeee"-->Download PDF</a>
        <!--<input type="submit" id="downloadPDF" name="downloadPDF" class="btn btn-danger" style="outline:0;" value="Download PDF"/>-->
    </div>
</div>

<div id="chartdiv">

</div>

</body>
</html>
