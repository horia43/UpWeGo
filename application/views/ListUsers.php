<!DOCTYPE html>

<?php
/**
 * Created by PhpStorm.
 * User: hstancu
 * Date: 10/17/2016
 * Time: 5:43 PM
 */ ?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login to UpWeGo</title>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/web/bootstrap-3.3.7-dist/css/mystyle.css">
    <script type="text/javascript" src="<?php echo base_url();?>/web/bootstrap-3.3.7-dist/js/listusers.js" ></script>


</head>
    <body>
    <p>Buna ziua,domnule <?php echo $username; ?> eu sunt USER, cu ce va pot ajuta ? -- Dar voi fi admin de fapt <br></p>
    <p>Eu am parola <?php echo $password ?>   </p>
    <p>Eu am email-ul <?php echo $email; ?>   </p>

    </body>
</html>











