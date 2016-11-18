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
    <title>List of Users</title>

    <link rel="stylesheet" href="<?php echo base_url(); ?>web/bootstrap-3.3.7-dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>web/bootstrap-3.3.7-dist/css/mystyle.css">

</head>
<body>
<p>Buna ziua,domnule <?php echo $username; ?> , dumneavoastra sunteti ADMIN, felicitari ! <br></p>
<p>Eu am parola <?php echo $password ?>   </p>
<p>Eu am email-ul <?php echo $email; ?>   </p>

<table id="table1" border="1">
    <thead>
    <tr>
        <th>Test Picture</th>
        <th>Profile Picture</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Username</th>
        <th>Email</th>
        <th>Add salary</th>
        <th>Edit User</th>
        <th>Delete User</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($myUsers as  $user): ?>
        <tr>
            <!--<td><img src="<?php /*echo $user['picture']; */?>" alt=" :( "></td>-->
            <!--<td><?php /*echo ( $user['picture'] );*/?><img src=<?php /*echo $user['picture']; */?>"data:image/jpeg;base64,'<?php /*base64_encode( $user['picture'] );*/?>'"/> </td>-->
            <!--<td><?php /*echo ( $user['picture'] );*/?><img width="80px" height="80px" style="border-radius:50%;"  src="<?php /*echo base_url()*/?>/upload/<?php /*echo $user['picture']; */?>"/> </td>-->
            <td><a onclick="divshow('<?php echo base_url()?>/upload/<?php echo $user['picture']; ?>')" ><img id="myImg"  style="width:150px; height:150px; border-radius:50%; object-fit:cover;"  src="<?php echo base_url()?>/upload/<?php echo $user['picture']; ?>"  alt="Image not found" onerror="this.onerror=null;this.src='<?php echo base_url()?>/upload/noprofilepic.jpg';"/></a></td>
            <td><div style="border-radius:50%; width:100px; height:100px; background: url(<?php echo base_url()?>upload/<?php echo $user['picture']; ?>) no-repeat center, url(<?php echo base_url()?>/upload/noprofilepic.jpg); background-size:cover;"></div></td>
            <td><?=$user['firstname']; ?></td>
            <td><?=$user['lastname']; ?></td>
            <td><?=$user['username']; ?></td>
            <td><?=$user['email']; ?></td>
            <td><a href="#">Add salary</a></td>
            <td><a href="#" onclick="window.location='<?php echo site_url("admin/pageedituser?id=").$user['id'];?>'">Edit</a></td>
            <td><a href="#">Delete</a></td>
        </tr>


    <?php endforeach;?>

    </tbody>
</table>



<button type="button" style="margin-left:350px; margin-top:20px; width:100px; height:30px; background-color:#ECFFC7;
        border-color:white; outline:none;"
        onclick="window.location='<?php echo site_url("admin/pageadduser");?>'">Add User</button>


<!--
<div data-role="popup" id="myPopup">
    <h4>Profile picture</h4>
    <a href="#pageone" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a><img src="skaret.jpg" style="width:800px;height:400px;" alt="Skaret View">
</div>-->

<div class="modal fade" id="viewprofilepic">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"
                        data-dismiss="modal">X</button>
                <h4 class="modal-title">Profile picture</h4>
            </div>
            <div class="modal-body" >
                <div id="divPicture" style="margin:0 auto; border-radius:5%; width:500px; height:500px;"></div>
            </div>
        </div>
    </div>
</div>




    <script type="text/javascript" src="<?php echo base_url(); ?>web/bootstrap-3.3.7-dist/js/listusers.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>web/bootstrap-3.3.7-dist/js/adduser.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>web/bootstrap-3.3.7-dist/js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>web/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
</body>
</html>











