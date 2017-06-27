<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add salary</title>
    <link rel="shortcut icon" href="http://legalservicesmiami.org/wp-content/uploads/2015/02/icon-money.png">


    <link rel="stylesheet" href="<?php echo base_url(); ?>web/bootstrap-3.3.7-dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/web/bootstrap-3.3.7-dist/css/mystyle.css">

    <script type="text/javascript" src="<?php echo base_url(); ?>web/bootstrap-3.3.7-dist/js/jquery-3.1.1.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/web/bootstrap-3.3.7-dist/js/addsalary.js"></script>

    <script>
        var base_url = "<?php echo base_url();?>";
    </script>

</head>
<body>
<div style="height:80px; min-width: 1270px;">
    <button class="button button1 to_home" type="button">
        <span class="glyphicon glyphicon-home"></span> Acasa
    </button>
    <button type="button" class="button button1 log_out">
        <span class="glyphicon glyphicon-log-out"></span> Delogare
    </button>
</div>
<div style="border:3px solid #2E4209; border-radius:5px; margin:0 auto; width:700px; height:450px; margin-top:120px;">
    <?php foreach($myUser as  $user): ?>
        <form method="post">
            <!--<div style="height:0px;overflow:hidden">
                <input type="file" id="fileInput" name="fileInput" accept="image/*"/>
                <input type="text" name="fileInputName" id="fileInputName" value=""></input>
            </div>-->

            <div onclick="divshow('<?php echo base_url()?>upload/<?php echo $user['picture']; ?>','<?php echo base_url()?>/upload/noprofilepic.jpg')"
                 style="float:left; width:150px; height:150px; margin-left:25px; margin-top:50px; margin-right:5px; border-radius:50%; background-color:#DDFFB3;">
                <img id="changePhoto"
                     style="object-fit:cover; width:150px; height:150px; border-radius:50%; border: 1px solid #B8EE9A;"
                     src="<?php echo base_url()?>upload/<?php echo $user['picture']; ?>"  alt="Image not found"
                     onerror="this.onerror=null;this.src='<?php echo base_url()?>/upload/noprofilepic.jpg';"/>
            </div>


            <div style="float:left; width:440px; margin-top:50px;">
                <fieldset style="border:1px solid darkgreen; height:270px; padding:30px;">
                    <p>First name: <?php echo $user['firstname']?></p>
                    <p>Last name: <?php echo $user['lastname']?></p>
                    <p>Email address: <?php echo $user['email']?></p>
                    <p>Username: <?php echo $user['username']?></p>
                    <p>Add salary: <input       type="number"   name="s_amount" size="20" min="0"   id="s_amount" required> RON</p>
                    <p>Month and Year: <input   type="month"    name="s_date"   id="myMonth" required></p>
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



<div class="modal fade" id="viewprofilepic2">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header" style="margin-bottom:0;border-bottom:none; color:white; background: rgba(0, 0, 0, 1); ">
                <button style="color:white;"type="button" class="close"
                        data-dismiss="modal">X</button>
                <h3 class="modal-title">Profile picture</h3>
            </div>
            <div class="modal-body" style="margin:0; padding:0px 0px 10px 0px; background: rgba(0, 0, 0, 1); " >
                <div id="divPicture2" style=" opacity:1 !important; margin:0 auto; border-radius:5%; width:500px; height:500px;"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>web/bootstrap-3.3.7-dist/js/jquery-3.1.1.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>/web/bootstrap-3.3.7-dist/js/addsalary.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>web/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>


</body>
</html>
