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
    <div style="width=100%; height:180px; background-color:#404856; color:white; font-weight: bold; overflow: hidden;">
        <div id="h1">Ziua de astazi</div>
        <div id="h2">ID ul utilizatorului</div>
    </div>
    <div class="common">
        <p>Detalii 1</p>
        <p>Nume Prenume</p>
        <p>Zi de nastere</p>
        <p>Email</p>
    </div>

    <div class="common">




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
        <button type="button" id="exportCSV" name="exportCSV" class="btn btn-warning" style="outline:0;">Exportare fisier CSV</button>

        <a id="downloadFlyer" href="<?php base_url();?>user/downloadPDF" class="btn btn-danger" target="_blank" style="visibility: hidden;" download> <!--download="awsomeeeee"-->Download PDF</a>
        <!--<input type="submit" id="downloadPDF" name="downloadPDF" class="btn btn-danger" style="outline:0;" value="Download PDF"/>-->

        <div id="chartdiv"></div>

    </div>

</div>

</body>
</html>
