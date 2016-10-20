<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login to UpWeGo</title>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/web/bootstrap-3.3.7-dist/css/mystyle.css">
    <script type="text/javascript" src="<?php echo base_url();?>/web/bootstrap-3.3.7-dist/js/ajax.js" ></script>
    <script type="text/javascript" src="<?php echo base_url();?>/web/bootstrap-3.3.7-dist/js/login.js" ></script>

</head>
<body>
    <div id="myForm">
        <form id="form1" action="<?php echo site_url('login/index') ?>">
            <div class="data">
                <p>User:</p>
                <p>Password:</p>
            </div>
            <div class="inputs">
                <p><input class="userpass" type="text" name="username" placeholder="Insert your name here"></p>
                <p><input class="userpass" type="password" name="password" placeholder="Insert your password here"></p>
            </div>
            <!--<div class="select"><select>
                    <option disabled selected>-- Select an option --</option>
                    <option>USER</option>
                    <option>ADMIN</option>
                </select>
            </div>-->
            <div id="logIn"><button id="btn1" type="button">Log in</button></div>
        </form>
    </div>

</body>
</html>
