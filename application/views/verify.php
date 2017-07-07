<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login to UpWeGo</title>
    <link rel="shortcut icon" href="http://findicons.com/files/icons/990/vistaico_toolbar/128/arrow_up.png">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/web/bootstrap-3.3.7-dist/css/animate.css">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/web/bootstrap-3.3.7-dist/css/mystyle.css">
    <script type="text/javascript" src="<?php echo base_url();?>/web/bootstrap-3.3.7-dist/js/ajax.js" ></script>
    <script type="text/javascript" src="<?php echo base_url();?>/web/bootstrap-3.3.7-dist/js/verify.js" ></script>
    <link href="https://fonts.googleapis.com/css?family=Mr+De+Haviland" rel="stylesheet">

    <script>
        var base_url = "<?php echo base_url();?>";
    </script>

</head>
<body id="verifyBody">
<div id="letter" style="margin-bottom:0px; margin-left:10px; min-width:430px; position: relative; " class="animated fadeInDown">
    UpWeGo
</div>
<div id="myForm" style="margin-top:80px;">
    <form id="form1" style="margin-top:50px;">

        <div class="group">
            <label class="label">Parola curenta:</label>
            <input id="current_pass" type="password" class="input" name="current_pass" placeholder="Introduceti parola livrata in email" style="color:white;">
        </div>
        <div class="group">
            <label class="label">Parola noua</label>
            <input id="new_pass" type="password" class="input" data-type="password" name="new_pass" placeholder="Introduceti noua parola">
        </div>
        <div class="group">
            <label class="label">Parola noua</label>
            <input id="new_pass2" type="password" class="input" data-type="password" name="new_pass2" placeholder="Reintroduceti noua parola">
        </div>
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($_GET['email']);?>">
        <input type="hidden" name="hash" value="<?php echo htmlspecialchars($_GET['hash']);?>">
        <!--<div class="select"><select>
                <option disabled selected>-- Select an option --</option>
                <option>USER</option>
                <option>ADMIN</option>
            </select>
        </div>-->
        <div id="activate"><button id="btn_activate" class="button button1" type="button">Activeaza contul</button></div>
    </form>
</div>
<div id="active_msg">

</div>

</body>
</html>
