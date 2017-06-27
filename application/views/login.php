<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login to UpWeGo</title>
    <link rel="shortcut icon" href="http://findicons.com/files/icons/990/vistaico_toolbar/128/arrow_up.png">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/web/bootstrap-3.3.7-dist/css/mystyle.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/web/bootstrap-3.3.7-dist/css/animate.css">
    <script type="text/javascript" src="<?php echo base_url();?>/web/bootstrap-3.3.7-dist/js/ajax.js" ></script>
    <script type="text/javascript" src="<?php echo base_url();?>/web/bootstrap-3.3.7-dist/js/login.js" ></script>
    <link href="https://fonts.googleapis.com/css?family=Mr+De+Haviland" rel="stylesheet">

</head>
<body id="loginBody" style="/*background-image:url('https://i.ytimg.com/vi/XxpxJty6K04/maxresdefault.jpg'); background-size:cover; */">

    <ul class="fly-in-text hidden">
        <li>S</li>
        <li>a</li>
        <li>l</li>
        <li>u</li>
        <li>t</li>
        <li>,</li>
        <li id="u_name" class="hidden2">
    </ul>
    <div id="letter" style="margin-bottom:-65px; margin-left:10px; min-width:430px; position: relative; " class="animated fadeInDown">
        UpWeGo
    </div>
    <div id="myForm" class="animated bounceInLeft">
        <h1>Formular de logare</h1>
        <form id="form1" action="<?php echo site_url('login/index') ?>">

            <div class="group">
                <label for="user" class="label">Utilizator</label>
                <input id="username" type="text" class="input" name="username" placeholder="Numele contului" style="color:white;">
            </div>
            <div class="group">
                <label for="pass" class="label">Parola</label>
                <input id="password" type="password" class="input" data-type="password" name="password" placeholder="Scrie aici parola">
            </div>



            <!--<div class="data">
                <p>User:</p>
                <p>Password:</p>
            </div>
            <div class="inputs">
                <p><input class="userpass" id="username" type="text" name="username" placeholder="Insert your name here"></p>
                <p><input class="userpass" id="password" type="password" name="password" placeholder="Insert your password here"></p>
            </div>-->
            <!--<div class="select"><select>
                    <option disabled selected>-- Select an option --</option>
                    <option>USER</option>
                    <option>ADMIN</option>
                </select>
            </div>-->
            <div id="logIn"><button id="btn1" class="button button1" type="button">Autentificare</button></div>
        </form>
    </div>

</body>
</html>
