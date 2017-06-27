<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add User</title>
    <link rel="shortcut icon" href="http://downloadicons.net/sites/default/files/plus-icon-76436.png">


    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/web/bootstrap-3.3.7-dist/css/mystyle.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/web/bootstrap-3.3.7-dist/js/adduser.js"></script>


</head>
<body>
<div style="border:3px solid #2E4209; border-radius:5px; margin:0 auto; width:700px; height:350px; margin-top:120px;">

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


        <div style="float:left; width:440px; margin-top:50px;">
            <fieldset style="border:1px solid darkgreen; height:180px;">
                <label for="lastname">Nume:</label><input type="text" name="lastname" size="20"><br>
                <label for="firstname">Prenume:</label><input type="text" name="firstname" size="20"><br>
                <label for="email">Adresa email:</label><input type="text" name="email" size="20" ><br>
                <label for="username">Nume utilizator:</label><input type="text" name="username" size="20"><br>
                    Departament:
                <select name="departament" id="parent_selection">
                        <option value="">-- Please Select --</option>
                        <option value="SisTem">SisTem</option>
                        <option value="PriorDana">PriorDana</option>
                        <option value="iT Tech">iT Tech</option>
                </select><br>
                    Functie:
                    <select name="functie" id="child_selection"></select>
            </fieldset>
        </div>
        <div style="width:100%; height:80px; clear:left; text-align:center;">
            <button type="submit"
                    style="width:100px; height:30px; background-color:#ECFFC7; border-color:white; outline:none; margin-top:50px;">
                Adaugare utilizator
            </button>
        </div>
    </form>
</div>

</body>
</html>
