<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Salary flyer</title>
    <style>
        .h2 {
            font-size: 30px;
            padding-top: 5px;
            text-align: center;
            font-weight: bolder;
        }
        #logo{
            position:relative;
            bottom:110px;
            right:70px;
            width:179px;
            height:200px;
            background: url(<?php echo base_url();?>upload/UpWeGo_Logo.png);
            float:right;
            clear:left;
        }
        #qr_code{
            width:200px;
            height:200px;
            background: url(<?php echo base_url();?>upload/qr_code_pdf.jpg);
            background-size:cover;
            float:right;
            display:inline-block;
            margin-bottom:45px;
            margin-right:100px;
        }
        .details{
            padding-top: 15px;
        }
        .details p {
            font-size: 13px;
            margin-top: 1px;
            margin-bottom: 1px;
            padding-top: 1px;
            padding-bottom: 1px;
        }
        .details p span,td span{
            font-weight: bold;
        }
        .details2 p{
            font-weight: bold;
            margin-top:10px;
            margin-bottom:0px;
        }
        table{
            width:80%;
            margin:40px auto;
        }
        table, th, td {
            border: 1px solid black;
        }
        .darker{
            background-color: #BEBEBE;
        }
    </style>

</head>
<body>
<div id="container-parent" style="font-family: 'Muli', sans-serif; background-color: #7f7f7f;">
    <div id="container" style="width: 90%; /*90%*/ border:2px solid #000000; background-color:#D8D8D8; overflow:hidden;">
        <div style="width:100%; height:auto; overflow: hidden; ">
            <div class="h1" style="width:190px; font-size: 35px; text-align: center; font-weight: bolder;">UpWeGo</div>
            <table style=" width:100%;">
                <tr>
                    <td style="width:32%;"></td>
                    <td style="width:33%; border-top:5px solid black;"></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="width:34%;"></td>
                    <td style="width:29%; border-top:3px solid #5f5f5f;"></td>
                    <td></td>
                </tr>
            </table>
            <div class="h2" style="clear:both; font-size: 25px; text-align: center; font-weight: bolder;">Pay Slip</div>
            <table style=" width:100%; padding-top:25px;">
                <tr>
                    <td style="width:51%; font-size: 10px;">
                        <span><b>Adress:</b> Calea Septembrie 13 , nr. 113	, Bucuresti	sector 5</span><br>
                        <span><b>Phone:</b> 021 224 75 21</span><br>
                        <span><b>Fax:</b> 021 224 75 20</span><br>
                        <span><a href="www.upwego.com">www.upwego.com</a></span><br><br><br>
                        <span><b>Nume si Prenume:</b></span><br>
                        <span><b>Anul si luna:</b></span><br>
                    </td>
                    <td style="width:20%;"></td>
                    <td  style="width:28%;"><img id="logo" width="120px" height="120px;" src="http://gorillaz/UpWeGo/upload/UpWeGo_Logo.png" />
                    </td>
                </tr>
            </table>
        </div><br>
        <table>
            <tr>
                <td width="15%"></td>
                <td width="70%">
                    <table border="1">
                        <tr>
                            <th colspan="3" style="text-align:center;"><b>Salariu de plata</b></th>
                        </tr>
                        <tr class="darker">
                            <td><span>Salariu de baza</span></td>
                            <td> </td>
                            <td style="text-align:right;">10000 (+)</td>
                        </tr>
                        <tr>
                            <td>Nr. tichete de masa</td>
                            <td> </td>
                            <td style="text-align:right;">20</td>
                        </tr>
                        <tr>
                            <td>Val. tichete de masa</td>
                            <td> </td>
                            <td style="text-align:right;">200</td>
                        </tr>
                        <tr>
                            <td>Decontare transport</td>
                            <td> </td>
                            <td style="text-align:right;">100(+)</td>
                        </tr>
                        <tr>
                            <td>Contributie C.A.S. </td>
                            <td style="text-align:right;">10.5%</td>
                            <td style="text-align:right;"> (-)</td>
                        </tr>
                        <tr>
                            <td>Contributie ajutor somaj </td>
                            <td style="text-align:right;">0.5%</td>
                            <td style="text-align:right;"> (-)</td>
                        </tr>
                        <tr>
                            <td>Contributie C.A.S.S. </td>
                            <td style="text-align:right;">5.5%</td>
                            <td style="text-align:right;"> (-)</td>
                        </tr>
                        <tr class="darker">
                            <td><span>Venit baza calc. impoz.</span></td>
                            <td> </td>
                            <td style="text-align:right;"> </td>
                        </tr>
                        <tr>
                            <td>Impozit</td>
                            <td style="text-align:right;">16%</td>
                            <td style="text-align:right;"> (-)</td>
                        </tr>
                        <tr class="darker">
                            <td><span>Salariu net</span></td>
                            <td></td>
                            <td style="text-align:right;"></td>
                        </tr>
                    </table>
                </td>
                <td width="14%"></td>
            </tr>
        </table>
        <p></p>
        <table>
            <tr>
                <td width="70%"></td>
                <td width="29%"><img id="qr_code" width="120px" height="120px;" src="http://gorillaz/UpWeGo/upload/qr_code_pdf.jpg" /></td>
            </tr>
        </table>
        <p></p>
    </div>
</div>
</body>
</html>
