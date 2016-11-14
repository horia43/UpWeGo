<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pinql</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli|Roboto+Condensed:300,400" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/web/bootstrap-3.3.7-dist/css/pinql.css">

</head>
<body>
    <div id="container">
        <div style="width=100%; height:180px; background-color:#404856; color:white; font-weight: bold; overflow: hidden;">
            <div id="h1">ETAT DES LIEUX - [CreationDate]</div>
            <div id="h2">ID bien #[PropertyObjectID]</div>
        </div>
        <div class="common">
            <p>Prorietaire</p>
            <p>[LandlordName][LandlordFirstName]</p>
            <p>[LandlordBirthday]</p>
            <p>[LandlordEmail]</p>
        </div>
        <div class="common">
            <p>[TenantName][TenantFirstName]</p>
            <p>[TenantBirthday]</p>
            <p>[TenantEmail]</p>
        </div>
        <div class="common">
            <p>Description generale</p>
            <p>[Address]</p>
            <p>[Price]</p>
            <p>[Guarantee]</p>
            <p>[NoRooms]</p>
            <p>[NoBedrooms]</p>
            <p>[NoToilets]</p>
            <p>[NoBathrooms]</p>
            <p>[Area]</p>
            <p>[Type]</p>
        </div>
        <div class="common">
            <p>Pieces</p>
            <p class="margintop">[RoomTitle1]</p>
            <section class="section1">[RoomDescription1] ------- Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
            </section>
            <div class="section2">
            <img src="http://placehold.it/350//000000?text=[RoomPicture1-1]">
            <img src="http://placehold.it/350//000000?text=[RoomPicture1-2]">
            <img src="http://placehold.it/350//000000?text=[RoomPicture1-3]">
            </div>

            <p class="margintop">[RoomTitle2]</p>
            <section class="section1">[RoomDescription2] ------- Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
            </section>
            <div class="section2">
                <img src="http://placehold.it/370//000000?text=[RoomPicture2-1]">
                <img src="http://placehold.it/370//000000?text=[RoomPicture2-2]">
                <img src="http://placehold.it/370//000000?text=[RoomPicture2-3]">
                <img src="http://placehold.it/370//000000?text=[RoomPicture2-4]">
                <img src="http://placehold.it/370//000000?text=[RoomPicture2-5]">
            </div>
        </div>
        <div class="common">
            <p>Pieces d'identites</p>
            <div class="pieces" >
                <p>Proprietaire</p>
                <img id="pieces1" src="http://placehold.it/600x350//000000?text=[LandlordID]">
            </div>
            <div class="pieces">
                <p>Locataire</p>
                <img id="pieces2" src="http://placehold.it/600x350//000000?text=[TenantID]">
            </div>
        </div>
        <div class="common2">
            <p>Signature</p>
            <div class="pieces" >
                <p>Proprietaire</p>
                <img id="pieces1" src="http://placehold.it/600x350//000000?text=[LandlordSignature]">
            </div>
            <div class="pieces">
                <p>Locataire</p>
                <img id="pieces2" src="http://placehold.it/600x350//000000?text=[TenantSignature]">
            </div>
        </div>
    </div>

</body>
</html>
