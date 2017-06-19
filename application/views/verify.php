<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login to UpWeGo</title>
    <link rel="shortcut icon" href="http://findicons.com/files/icons/990/vistaico_toolbar/128/arrow_up.png">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/web/bootstrap-3.3.7-dist/css/mystyle.css">
    <script type="text/javascript" src="<?php echo base_url();?>/web/bootstrap-3.3.7-dist/js/ajax.js" ></script>
    <script type="text/javascript" src="<?php echo base_url();?>/web/bootstrap-3.3.7-dist/js/verify.js" ></script>

    <script>
        var base_url = "<?php echo base_url();?>";
    </script>

</head>
<body>
<div id="myForm">
    <form id="form3">
        <div class="data">
            <p>Current password:</p>
            <p>New password:</p>
            <p>Retype password:</p>
        </div>
        <div class="inputs">
            <p><input class="userpass" id="current_pass" type="password" name="current_pass" placeholder="Insert password given by email"></p>
            <p><input class="userpass" id="new_pass" type="password" name="new_pass" placeholder="Insert your new password here"></p>
            <p><input class="userpass" id="new_pass2" type="password" name="new_pass2" placeholder="Retype your password here"></p>
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($_GET['email']);?>">
            <input type="hidden" name="hash" value="<?php echo htmlspecialchars($_GET['hash']);?>">
        </div>
        <!--<div class="select"><select>
                <option disabled selected>-- Select an option --</option>
                <option>USER</option>
                <option>ADMIN</option>
            </select>
        </div>-->
        <div id="activate"><button id="btn_activate" type="button">Activate account</button></div>
    </form>
</div>
<div id="active_msg">

</div>

</body>
</html>
