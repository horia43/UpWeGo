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

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/web/bootstrap-3.3.7-dist/css/mystyle.css">
    <script type="text/javascript" src="<?php echo base_url(); ?>/web/bootstrap-3.3.7-dist/js/adduser.js"></script>


</head>
<body>
<p>Buna ziua,domnule <?php echo $username; ?> , dumneavoastra sunteti ADMIN, felicitari ! <br></p>
<p>Eu am parola <?php echo $password ?>   </p>
<p>Eu am email-ul <?php echo $email; ?>   </p>

<table id="table1" border="1">
    <thead>
    <tr>
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
            <!--<td><?php /*echo ( $user['picture'] );*/?><img width="150px" height="150px" style="border-radius:50%;"  src="<?php /*echo base_url()*/?>/upload/<?php /*echo $user['picture']; */?>"  alt="Image not found" onerror="this.onerror=null;this.src='<?php /*echo base_url()*/?>/upload/noprofilepic.jpg';"/> </td>-->
            <td><div style="border-radius:50%; width:100px; height:100px; background: url(<?php echo base_url()?>/upload/<?php echo $user['picture']; ?>) no-repeat center, url(<?php echo base_url()?>/upload/noprofilepic.jpg); background-size:cover;"></div></td>
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


</body>
</html>











