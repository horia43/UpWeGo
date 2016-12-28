<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/web/bootstrap-3.3.7-dist/css/mystyle.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/web/bootstrap-3.3.7-dist/js/edituser.js"></script>


</head>
<body>
<div style="border:3px solid #2E4209; border-radius:5px; margin:0 auto; width:700px; height:350px; margin-top:120px;">
    <?php foreach($myUser as  $user): ?>
    <form method="post" enctype="multipart/form-data">
        <div style="height:0px;overflow:hidden">
            <input type="file" id="fileInput" name="fileInput" accept="image/*"/>
            <input type="text" name="fileInputName" id="fileInputName" value=""></input>
        </div>

        <div style="float:left; width:150px; height:150px; margin-left:25px; margin-top:50px; margin-right:5px; border-radius:50%; background-color:#DDFFB3; ">
            <img id="changePhoto" onclick="chooseFile();"
                 style="object-fit:cover; width:150px; height:150px; border-radius:50%; border: 1px solid #B8EE9A;"
                 src="<?php echo base_url()?>/upload/<?php echo $user['picture']; ?>"  alt="Image not found"
                 onerror="this.onerror=null;this.src='<?php echo base_url()?>/upload/noprofilepic.jpg';"/>
        </div>


        <div style="float:left; width:440px; margin-top:50px;">
            <fieldset style="border:1px solid darkgreen; height:180px;">
                <label for="firstname">First name:</label><input type="text" name="firstname" size="20" value="<?php echo $user['firstname']?>"<br>
                <label for="lastname">Last name:</label><input type="text" name="lastname" size="20" value="<?php echo $user['lastname']?>"><br>
                <label for="email">Email address:</label><input type="text" name="email" size="20"  value="<?php echo $user['email']?>"><br>
                <label for="username">Username:</label><input type="text" name="username" size="20" value="<?php echo $user['username']?>"><br>
            </fieldset>
        </div>
        <div style="width:100%; height:80px; clear:left; text-align:center;">
            <button type="submit"
                    style="width:120px; height:30px; background-color:#ECFFC7; border-color:white; outline:none; margin-top:50px;">
                Save Changes
            </button>
        </div>
    </form>
    <?php endforeach;?>
</div>

</body>
</html>
