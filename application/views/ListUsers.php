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
    <link rel="shortcut icon" href="http://pm1.narvii.com/6223/68e9e8ca084e06b0e5f05dcf7efcee8ab0406c36_hq.jpg">

    <link rel="stylesheet" href="<?php echo base_url(); ?>web/bootstrap-3.3.7-dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>web/bootstrap-3.3.7-dist/css/mystyle.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/web/bootstrap-3.3.7-dist/css/animate.css">

    <link href="https://fonts.googleapis.com/css?family=Mr+De+Haviland" rel="stylesheet">

    <script type="text/javascript" src="<?php echo base_url(); ?>web/bootstrap-3.3.7-dist/js/jquery-3.1.1.min.js"></script>



</head>
<body>
<!--<p>Buna ziua,domnule <?php /*echo $username; */?> , dumneavoastra sunteti ADMIN, felicitari ! <br></p>
<p>Eu am parola <?php /*echo $password */?>   </p>
<p>Eu am email-ul <?php /*echo $email; */?>   </p>-->
<div style="height:80px; min-width: 1270px;">
    <button class="button button1 to_home" type="button">
        <span class="glyphicon glyphicon-home"></span> Acasa
    </button>
    <button type="button" class="button button1 log_out">
        <span class="glyphicon glyphicon-log-out"></span> Delogare
    </button>
</div>
<div id="letter" class="animated fadeInDown">
    UpWeGo
</div>

<table id="table1" class="table-striped" border="1">
    <thead>
        <tr>
            <th colspan="10">
                <div style="width:25%;float:left;margin:0;">
                    &nbsp;
                </div>

                <div style="width:51%;float:left;margin-top:15px;">
                    <h1 class="listaAngajati" style="width:400px; margin:0 auto; height: 100%">
                        Lista Angajati
                        <span class="shade">&nbsp;</span>
                    </h1>
                </div>

                <div style="width:24%;float:right;margin:0px;">
                    <span class="addUser2">Adauga utilizator:</span><button type="button" class="addUser" style="float:right;"
                            onclick="window.location='<?php echo site_url("admin/pageadduser");?>'" title="Adauga utilizator">+</button>
                </div>

            </th>

        </tr>
        <tr>
            <!--<th>Test Picture</th>-->
            <th>Poza de profil</th>
            <th>Nume</th>
            <th>Prenume</th>
            <th>Utilizator</th>
            <th>Email</th>
            <th>Departament</th>
            <th>Functie</th>
            <th>Adauga salariu</th>
            <th>Editeaza utilizator</th>
            <th>Sterge utilizator</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($myUsers as  $user): ?>
        <tr>
            <!--<td><img src="<?php /*echo $user['picture']; */?>" alt=" :( "></td>-->
            <!--<td><?php /*echo ( $user['picture'] );*/?><img src=<?php /*echo $user['picture']; */?>"data:image/jpeg;base64,'<?php /*base64_encode( $user['picture'] );*/?>'"/> </td>-->
            <!--<td><?php /*echo ( $user['picture'] );*/?><img width="80px" height="80px" style="border-radius:50%;"  src="<?php /*echo base_url()*/?>/upload/<?php /*echo $user['picture']; */?>"/> </td>-->
            <!--<td><a onclick="divshow('<?php /*echo base_url()*/?>/upload/<?php /*echo $user['picture']; */?>','<?php /*echo base_url()*/?>/upload/noprofilepic.jpg')" ><img id="myImg"  style="width:150px; height:150px; border-radius:50%; object-fit:cover;"  src="<?php /*echo base_url()*/?>/upload/<?php /*echo $user['picture']; */?>"  alt="Image not found" onerror="this.onerror=null;this.src='<?php /*echo base_url()*/?>/upload/noprofilepic.jpg';"/></a></td>-->
            <td><div onclick="divshow('<?php echo base_url()?>upload/<?php echo $user['picture']; ?>','<?php echo base_url()?>upload/noprofilepic.jpg')"  style="border-radius:50%; width:150px; height:150px; background: url(<?php echo base_url()?>upload/<?php echo $user['picture']; ?>) no-repeat center, url(<?php echo base_url()?>/upload/noprofilepic.jpg); background-size:cover;"></div></td>
            <td><?=$user['lastname']; ?></td>
            <td><?=$user['firstname']; ?></td>
            <td><?=$user['username']; ?></td>
            <td><?=$user['email']; ?></td>
            <td>Departament</td>
            <td>Functie</td>
            <td><a href="#" onclick="window.location='<?php echo site_url("admin/pageaddsalary?id=").$user['id'];?>'">Add salary</a></td>
            <td><a href="#" onclick="window.location='<?php echo site_url("admin/pageedituser?id=").$user['id'];?>'">Edit</a></td>
            <td><a href="#">Delete</a></td>
        </tr>


    <?php endforeach;?>

    </tbody>
</table>
<div class="center">
    <ul class="pagination">

        <!-- ARROWS LEFT -->

        <?php if(  isset($_GET['page'])) : ?>
            <?php if($_GET['page']!=1) : ?>
                <li><a class="arrow2" onclick="window.location='<?php echo site_url("admin/pageindex?page=1")."&items=".$_GET["items"];?>'">&laquo;</a></li>
                <li><a class="arrow1" onclick="window.location='<?php echo site_url("admin/pageindex?page=").($_GET["page"]-1)."&items=".$_GET["items"];?>'">&lt;</a></li>
            <?php endif ?>
        <?php endif ?>


        <?php if(  isset($_GET['page'])) : ?>                                               <!-- EXISTA PARAMETRUL PAGE ?   -->
            <?php if($pageCount>=5) : ?>                                                    <!-- DACA AM MAI MULT DE 5 PAGINI DE AFISAT -->
                <?php if(  $_GET['page']<=3 ) : ?>                                          <!-- DACA MA AFLU PRINTRE PRIMELE PAGINI, AFISEZ DOAR 1 2 3 4 5  -->
                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                        <li id="list-<?php echo $i;?>" ><a onclick="window.location='<?php echo site_url("admin/pageindex?page=").$i."&items=".$_GET["items"];?>'"><?php echo $i;?></a></li>
                    <?php endfor ?>
                <?php endif ?>

                <?php if(  $_GET['page']>3 && $_GET['page']<=$pageCount-2 ) : ?>             <!-- DACA MA AFLU LA MIJLOC, AFISEZ DOAR -2 -1 page +1 +2  -->
                    <?php for ($i = $_GET['page']-2; $i <= $_GET['page']+2; $i++) : ?>
                        <li id="list-<?php echo $i;?>" ><a onclick="window.location='<?php echo site_url("admin/pageindex?page=").$i."&items=".$_GET["items"];?>'"><?php echo $i;?></a></li>
                    <?php endfor ?>
                <?php endif ?>

                <?php if(  $_GET['page']>$pageCount-2 ) : ?>                               <!-- DACA MA AFLU PRINTRE ULTIMELE PAGINI, AFISEZ DOAR -4 -3 -2 -1 last  -->
                    <?php if($pageCount!=5) : ?>
                        <?php for ($i = $pageCount-4; $i <= $pageCount; $i++) : ?>
                            <li id="list-<?php echo $i;?>" ><a onclick="window.location='<?php echo site_url("admin/pageindex?page=").$i."&items=".$_GET["items"];?>'"><?php echo $i;?></a></li>
                        <?php endfor ?>
                    <?php else: ?>
                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                            <li id="list-<?php echo $i;?>" ><a onclick="window.location='<?php echo site_url("admin/pageindex?page=").$i."&items=".$_GET["items"];?>'"><?php echo $i;?></a></li>
                        <?php endfor ?>
                    <?php endif ?>
                <?php endif ?>

            <?php else : ?>                                                                 <!-- DACA NU, AFISEZ DOAR PAGINILE PE CARE LE AM (I.E. 1 2 3 )   -->
                <?php for ($i = 1; $i <= $pageCount; $i++) : ?>
                    <li id="list-<?php echo $i;?>" ><a onclick="window.location='<?php echo site_url("admin/pageindex?page=").$i."&items=".$_GET["items"];?>'"><?php echo $i;?></a></li>
                <?php endfor ?>
            <?php endif ?>
        <?php else : ?>                                                                     <!-- DACA NU AM PARAMETRUL PAGE / inseamna ca sunt pe prima pagina-->
            <?php if($pageCount>=5) :?>
                <?php for ($i = 1; $i <= 5; $i++) : ?>                                      <!-- AFISEZ DOAR 1 2 3 4 5  -->
                    <li id="list-<?php echo $i;?>" ><a onclick="window.location='<?php echo site_url("admin/pageindex?page=").$i."&items=5";?>'"><?php echo $i;?></a></li>
                <?php endfor ?>
            <?php else : ?>
                <?php for ($i = 1; $i <= $pageCount; $i++) : ?>                             <!-- AFISEZ DOAR 1 2 3 ( sunt mai putine pagini decat 5 )  -->
                    <li id="list-<?php echo $i;?>" ><a onclick="window.location='<?php echo site_url("admin/pageindex?page=").$i."&items=5";?>'"><?php echo $i;?></a></li>
                <?php endfor ?>
            <?php endif ?>
        <?php endif ?>

        <!--  ARROWS RIGHT -->

        <?php if(  isset($_GET['page'])) : ?>
            <?php if($_GET['page']!=$pageCount) : ?>
                <li><a class="arrow1" onclick="window.location='<?php echo site_url("admin/pageindex?page=").($_GET["page"]+1)."&items=".$_GET["items"];?>'">&gt;</a></li>
                <li><a class="arrow2" onclick="window.location='<?php echo site_url("admin/pageindex?page=").$pageCount."&items=".$_GET["items"];?>'">&raquo;</a></li>
            <?php endif ?>

            <!--  ARROWS RIGHT -->

        <?php else : ?>
            <li><a class="arrow1" onclick="window.location='<?php echo site_url("admin/pageindex?page=2")."&items=5"; ?>'">&gt;</a></li>
            <li><a class="arrow2" onclick="window.location='<?php echo site_url("admin/pageindex?page=").$pageCount."&items=5";?>'">&raquo;</a></li>
        <?php endif ?>
    </ul>
</div>
<div style="text-align:center; min-width: 1270px; margin-bottom:50px;">
    <div style="margin:auto; width:200px;">

        <div class="input-group" style="margin-bottom:7px; margin-left: 50px;">
            <span class="input-group-addon" title="Go to page">
                <i class="glyphicon glyphicon-arrow-right"></i>
            </span>
            <input id="goto_page" type="number" class="form-control small-input" title="Go to page">
            <span id="pageCount" >/<?php echo $pageCount; ?></span>
            <!--<input type="text" id="pageCount" value="<?php /*echo $pageCount; */?>" >-->
        </div>

        <div class="input-group" style=" margin-left: 50px;">
            <span class="input-group-addon" title="Rows per page">
                <i class="glyphicon glyphicon-th-list"></i>
            </span>
            <input id="rows_per_page" name="rows_per_page" value="5" type="number" class="form-control small-input" title="Rows per page">
        </div>
    </div>
</div>

<!--
<div class="example">
    <nav>
        <ul class="pagination">
            <li class="disabled">
                <a href="#" aria-label="Previous">
                    <span aria-hidden="true">«</span>
                </a>
            </li>
            <li class="active"><a href="#">1</a>
            </li>
            <li><a href="#">2</a>
            </li>
            <li><a href="#">3</a>
            </li>
            <li><a href="#">4</a>
            </li>
            <li><a href="#">5</a>
            </li>
            <li>
                <a href="#" aria-label="Next">
                    <span aria-hidden="true">»</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
-->





<!--
<div data-role="popup" id="myPopup">
    <h4>Profile picture</h4>
    <a href="#pageone" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a><img src="skaret.jpg" style="width:800px;height:400px;" alt="Skaret View">
</div>-->

<div class="modal fade" id="viewprofilepic">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header" style="margin-bottom:0;border-bottom:none; color:white; background: rgba(0, 0, 0, 1); ">
                <button style="color:white;"type="button" class="close"
                        data-dismiss="modal">X</button>
                <h3 class="modal-title">Profile picture</h3>
            </div>
            <div class="modal-body" style="margin:0; padding:0px 0px 10px 0px; background: rgba(0, 0, 0, 1); " >
                <div id="divPicture" style=" opacity:1 !important; margin:0 auto; border-radius:5%; width:500px; height:500px;"></div>
            </div>
        </div>
    </div>
</div>




    <script type="text/javascript" src="<?php echo base_url(); ?>web/bootstrap-3.3.7-dist/js/listusers.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>web/bootstrap-3.3.7-dist/js/adduser.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>web/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

<!--<script type="text/javascript">
    $(document).ready(function(){
        //    $("#list-<?php/*echo $_GET["page"];*/ ?> a").css("background-color","pink");
        $("#list-<?php /*echo $_GET["page"]; */?>").addClass("active");
    });
</script>-->

</body>
</html>











