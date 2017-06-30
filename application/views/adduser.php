<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add User</title>
    <link rel="shortcut icon" href="http://downloadicons.net/sites/default/files/plus-icon-76436.png">

    <link rel="stylesheet" href="<?php echo base_url(); ?>web/bootstrap-3.3.7-dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/web/bootstrap-3.3.7-dist/css/mystyle.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/web/bootstrap-3.3.7-dist/js/adduser.js"></script>

    <script>
        var base_url = "<?php echo base_url();?>";
    </script>
</head>
<body>
<div style="height:80px; width:100%; min-width:700px;">
    <button class="button button1 to_home2" type="button">
        <span class="glyphicon glyphicon-home"></span> Acasa
    </button>
    <button type="button" class="button button1 log_out2">
        <span class="glyphicon glyphicon-log-out"></span> Delogare
    </button>
</div>
<div style="border:2px solid #dcffff; border-radius:50px; margin:0 auto; width:700px; height:630px; margin-top:60px; background-color:#d4fff8;">

    <form method="post" enctype="multipart/form-data">
        <div style="height:0px;overflow:hidden">
            <input type="file" id="fileInput" name="fileInput" accept="image/*"/>
            <input type="text" name="fileInputName" id="fileInputName" value=""></input>
        </div>

        <div style="float:left; width:150px; height:150px; margin-left:25px; margin-top:50px; margin-right:5px; border-radius:50%; background-color:white;">
            <!--<img id="addPhoto" src="https://cdn1.iconfinder.com/data/icons/ui-5/502/user-512.png" alt="Add photo of user" width="110px" height="110px">-->

            <img id="addPhoto" onclick="chooseFile();"
                 src="https://cdn1.iconfinder.com/data/icons/ui-5/502/user-512.png" alt="Add photo of user"
                 style="border-radius:50%; width: 100%; height: 100%; border: 1px; object-fit:cover;">

        </div>


        <div style="float:left; width:440px; margin-top:50px; border:1px solid darkgray;border-radius:25px; padding-top:20px; margin-left:30px; padding-bottom:10px; color:#ffffff;">
            <div class="group2">
                <label class="label2">Nume</label>
                <input id="lastname" type="text" class="input" name="lastname" placeholder="Numele utilizatorului">
            </div>

            <div class="group2">
                <label class="label2">Prenume</label>
                <input id="firstname" type="text" class="input" name="firstname" placeholder="Prenumele utilizatorului">
            </div>

            <div class="group2">
                <label class="label2">Email</label>
                <input id="email" type="text" class="input" name="email" placeholder="Email-ul utilizatorului">
            </div>

            <div class="group2">
                <label class="label2">Utilizator</label>
                <input id="username" type="text" class="input" name="username" placeholder="Numele contului">
            </div>

            <div class="group2">
                <label class="label2">Departament</label>
                <select name="departament" id="parent_selection">
                    <option value="">- - Selecteaza - -</option>
                    <option value="SisTem">SisTem</option>
                    <option value="PriorDana">PriorDana</option>
                    <option value="iT Tech">iT Tech</option>
                </select>
            </div>

            <div class="group2">
                <label class="label2">Functie</label>
                <select name="functie" id="child_selection"></select>
            </div>

        </div>
        <div style="width:100%; height:80px; clear:left; text-align:center;">
            <button type="submit" class="button button1"
                    style="outline:none; margin-top:50px;">
                <span class="glyphicon glyphicon-plus-sign"></span> Adaugare utilizator
            </button>
        </div>
    </form>
</div>

</body>
</html>
