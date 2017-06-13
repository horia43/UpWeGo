<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sample site</title>
    <style>
        body{
            margin:0;
        }
        #container-parent {
            font-family: 'Muli', sans-serif;
            background-color: #7f7f7f;
            padding: 5% 0;
        }

        #container {
            width: 1000px; /*90%*/
            margin: 0 auto;
            top:150px;
            border:1px solid black;
            background-color:#D8D8D8;

        }

        .h1 {
            width:190px;
            margin:0 auto;
            font-size: 45px;
            padding-top: 50px;
            text-align: center;
            border-bottom:3px solid black;
        }

        .h2 {
            font-size: 30px;
            padding-top: 5px;
            text-align: center;
        }
        #logo{
            position:relative;
            bottom:110px;
            right:70px;
            width:179px;
            height:200px;
            background: url(<?php echo base_url()?>/upload/UpWeGo_Logo.png);
            float:right;
            clear:left;
        }
        p:first-child {
            font-size: 28px;
            color: #376a1f;
            margin-bottom: 1px;
            margin-top: 45px;
            padding-top: 1px;
            padding-bottom: 1px;
        }

        div p {
            font-size: 28px;
            color: #2faca9;

            margin-top: 1px;
            margin-bottom: 1px;
            padding-top: 1px;
            padding-bottom: 1px;

        }

        p:last-child {
            margin-bottom: 45px;
        }

        .margintop {
            margin-top: 70px;
        }

        .common {
            border-bottom: 2px solid #fffad3;
            margin-left: 45px;
            margin-right: 150px;
        }

        .section1 {
            font-size: 20px;
            color: #bcb8b0;
            margin-top: 35px;
            margin-bottom: 35px;
        }

        .section2 {
            margin-bottom: 45px;
        }

        .section2 img {
            margin-right: 20px;
            margin-top: 20px;
        }

        .pieces {
            display: inline-block;
        }

        .pieces p {
            font-size: 28px;
            color: #23bc8d;
        }

        #pieces1 {
            margin-right: 30px;
            margin-top: 15px;
            margin-bottom: 45px;

        }

        #pieces2 {
            margin-top: 15px;
            margin-bottom: 45px;
        }

        .common2 {
            margin-left: 45px;
            margin-right: 150px;
        }
    </style>

</head>
<body>
<div id="container-parent">
    <div id="container">
        <div style="width:100%; height:380px; font-weight: bolder; overflow: hidden; ">
            <div class="h1">UpWeGo</div><hr style="width:160px; height:2px; background-color:#3c3c3c;"><hr style="width:120px; height:2px;background-color:#5f5f5f;">
            <div class="h2" style="clear:both;">Pay Slip</div>
            <div id="logo">
            </div>
        </div>
        <div class="common">
            <p>Detalii 1</p>
            <p>Nume Prenume</p>
            <p>Zi de nastere</p>
            <p>Email</p>
        </div>
        <div class="common">
            <p>Nume Prenume</p>
            <p>Zi nastere</p>
            <p>Email</p>
        </div>
        <div class="common">
            <p>Descriere</p>
            <p>Adresa</p>
            <p>Salariu</p>
            <p>Pozitie ocupata</p>
            <p>Program de lucru</p>
            <p>xdwasd</p>
            <p>hsdfbgse</p>
            <p>fesfzfeazf</p>
            <p>sefvdxservaer</p>
            <p>gfdrveg</p>
        </div>
        <div class="common">
            <p>Zodie</p>
            <p class="margintop">Astrologie</p>
            <section class="section1">[RoomDescription1] ------- Lorem Ipsum is simply dummy text of the printing and
                typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when
                an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived
                not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
            </section>
            <div class="section2">
                <img src="http://placehold.it/350//000000?text=[Zodiac-1]">
                <img src="http://placehold.it/350//000000?text=[Zodiac-2]">
                <img src="http://placehold.it/350//000000?text=[Zodiac-3]">
            </div>

            <p class="margintop">Compatibilitati</p>
            <section class="section1">[RoomDescription2] ------- Lorem Ipsum is simply dummy text of the printing and
                typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when
                an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived
                not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
            </section>
            <div class="section2">
                <img src="http://placehold.it/370//000000?text=[Exemplu-1]">
                <img src="http://placehold.it/370//000000?text=[Exemplu-2]">
                <img src="http://placehold.it/370//000000?text=[Exemplu-3]">
                <img src="http://placehold.it/370//000000?text=[Exemplu-4]">
                <img src="http://placehold.it/370//000000?text=[Exemplu-5]">
            </div>
        </div>
        <div class="common">
            <p>Informatii generale</p>
            <div class="pieces">
                <p>Info 1</p>
                <img id="pieces1" src="http://placehold.it/600x350//000000?text=[Verde de Paris]">
            </div>
            <div class="pieces">
                <p>Info 2</p>
                <img id="pieces2" src="http://placehold.it/600x350//000000?text=[Mos Craciun]">
            </div>
        </div>
        <div class="common2">
            <p>Arta digitala</p>
            <div class="pieces">
                <p>Creion</p>
                <img id="pieces1" src="http://placehold.it/600x350//000000?text=[Dragon-creion]">
            </div>
            <div class="pieces">
                <p>Pastel</p>
                <img id="pieces2" src="http://placehold.it/600x350//000000?text=[Dragon-pastel]">
            </div>
        </div>
    </div>
</div>

</body>
</html>
