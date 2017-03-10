<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add salary</title>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/web/bootstrap-3.3.7-dist/css/mystyle.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/web/bootstrap-3.3.7-dist/js/addsalary.js.js"></script>


</head>
<body>
<div style="border:3px solid #2E4209; border-radius:5px; margin:0 auto; width:700px; height:450px; margin-top:120px;">
    <?php foreach($myUser as  $user): ?>
        <form method="post" enctype="multipart/form-data">
            <div style="height:0px;overflow:hidden">
                <input type="file" id="fileInput" name="fileInput" accept="image/*"/>
                <input type="text" name="fileInputName" id="fileInputName" value=""></input>
            </div>

            <div style="float:left; width:150px; height:150px; margin-left:25px; margin-top:50px; margin-right:5px; border-radius:50%; background-color:#DDFFB3; ">
                <img id="changePhoto" onclick="chooseFile();"
                     style="object-fit:cover; width:150px; height:150px; border-radius:50%; border: 1px solid #B8EE9A;"
                     src="<?php echo base_url()?>upload/<?php echo $user['picture']; ?>"  alt="Image not found"
                     onerror="this.onerror=null;this.src='<?php echo base_url()?>/upload/noprofilepic.jpg';"/>
            </div>


            <div style="float:left; width:440px; margin-top:50px;">
                <fieldset style="border:1px solid darkgreen; height:270px;">
                    <p>First name: <?php echo $user['firstname']?></p>
                    <p>Last name: <?php echo $user['lastname']?></p>
                    <p>Email address: <?php echo $user['email']?></p>
                    <p>Username: <?php echo $user['username']?></p>
                    <p>Add salary: <input type="number" name="s_amount" size="20"> RON</p>
                    <p>Month and Year: <input type="month" id="myMonth"></p>
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
