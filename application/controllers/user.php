<?php

class User extends CI_Controller
{


    function __construct()
    {
        parent::__construct();
    }

    function index()
    {

        if ($this->session->userdata('logged_in') && !$this->session->userdata('logged_in')['isAdmin']) //// dar in teorie nu am nevoie decat de username ca sa il afisez pe undeva :) Majoritatea lor sunt doar pentru testare
        {

            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $data['password'] = $session_data['password'];  // doar pentru testare
            $data['email'] = $session_data['email'];          // doar pentru testare

            $data['isAdmin'] = $session_data['isAdmin'];    // doar pentru testare
            $data['logged_in'] = $session_data['logged_in'];
            //$this->load->view('ListUsers',$data);
        } else {
            //If no session, redirect to login page
            redirect('welcome', 'refresh');
        }

        $this->load->database();

        $this->db->select("id");
        $this->db->where('username=', $data['username']);
        $query = $this->db->get("user");
        $id_employee = $query->result_array()[0]['id'];

        $yearPicked = "2017";


        $this->db->select("*");
        $this->db->where("id_employee=", $id_employee);
        $this->db->like("s_date", $yearPicked);
        $select = $this->db->get("salary");

        //$select = $this->db->query('SELECT * FROM salary WHERE id_employee="' . $id_employee . '"');
        $jsonArray = array();


        if ($select->num_rows() > 0) {
            foreach ($select->result_array() as $row) {
                $jsonArrayItem = array();
                $jsonArrayItem['payment_id'] = $row['payment_id'];
                $jsonArrayItem['s_date'] = $row['s_date'];
                $jsonArrayItem['s_amount'] = $row['s_amount'];
                //append the above created object into the main array.
                array_push($jsonArray, $jsonArrayItem);
            }
        }

        $jsonArray = json_encode($jsonArray);
        $data['json'] =$jsonArray;

        /*header('Content-type: application/json');
        echo '<pre>';
        print_r($jsonArray);
        echo '</pre>';
        echo json_encode($jsonArray);*/
        //$row = $select->fetch_array();
        //echo '<pre>';
        //var_dump($row);
        //print_r($select);
        //echo $row;
        //echo '</pre>';


        /*$user_details = $select->result_array();
        $data['userDetails'] = $user_details;*/

        /*$response = array(
            "success" => true//, // e o cheie de tip string success
        );
        echo json_encode($response);
        */
        //if ($this->input->post($yearPicked) == null) {
        $this->load->view('user', $data);
        //$this->load->view('flyer');
        //}

    }

    function changeChart()
    {
        try {


            if ($this->session->userdata('logged_in') && !$this->session->userdata('logged_in')['isAdmin']) //// dar in teorie nu am nevoie decat de username ca sa il afisez pe undeva :) Majoritatea lor sunt doar pentru testare
            {

                $session_data = $this->session->userdata('logged_in');
                $data['username'] = $session_data['username'];
                $data['password'] = $session_data['password'];  // doar pentru testare
                $data['email'] = $session_data['email'];          // doar pentru testare

                $data['isAdmin'] = $session_data['isAdmin'];    // doar pentru testare
                $data['logged_in'] = $session_data['logged_in'];
                //$this->load->view('ListUsers',$data);
            } else {
                //If no session, redirect to login page
                redirect('login', 'refresh');
            }

            $this->load->database();

            $this->db->select("id");
            $this->db->where('username=', $data['username']);
            $query = $this->db->get("user");
            $id_employee = $query->result_array()[0]['id'];

            $yearPicked = $this->input->post('yearPicker');


            $this->db->select("*");
            $this->db->where("id_employee=", $id_employee);
            $this->db->like("s_date", $yearPicked);
            $select = $this->db->get("salary");


            //propunere formatare date

            $salaries = array();
            $months=array("Ianuarie", "Februarie", "Martie", "Aprilie", "Mai", "Iunie", "Iulie", "August","Septembrie","Octombrie","Noiembrie","Decembrie");

            for($i=1; $i<=12; $i++){
                //$date = substr(sprintf("%s-%02d", $yearPicked, $i),5);        // date = 2017-01/02/03/04/05/...11/12
                //$date = substr(sprintf("%s-%d", $yearPicked, $i),5);        // date = 2017-01/02/03/04/05/...11/12
                $date=$months[$i-1];                                            //date=Jan,Feb, etc.
                $salaries[$date] = array(                           // salaries["2017-01"] = { "s_date" : "2017-01" , "s_amount" : 0 }
                    "s_date"    =>  $date,                          // salaries["2017-02"] = { "s_date" : "2017-02" , "s_amount" : 0 }
                    "s_amount"  =>  0
                );
            }


            /*if ($select->num_rows() > 0) {
            foreach ($select->result_array() as $row) {                                 //$row["s_date"] == "2017-01", il numim $data , valoare extrasa din db
                    $salaries [$row['s_date']] ["s_amount"] = $row['s_amount'];           //$salaries [$data] ["s_amount"] = $row["amount"]  in salaries,
                }                                                                       //la obiectul retinut la indexul data , schimba ammount cu valoarea din db
            }*/
            /*if ($select->num_rows() > 0) {
                foreach ($select->result_array() as $row) {
                    $salaries[$row['s_date']] = array(
                        "s_date"    =>  $row['s_date'],
                        "s_amount"  =>  $row['s_amount']
                    );
                }
            }*/

            if ($select->num_rows() > 0) {
                foreach ($select->result_array() as $row) {
                    $row["s_date"]=$months[substr($row["s_date"],6)-1];        // * //
                    $salaries[$row['s_date']] = array(
                        "s_date"    =>  $row['s_date'],
                        "s_amount"  =>  $row['s_amount']
                    );
                }
            }
            $salaries_json = json_encode(array_values($salaries));










            $month = '01';
            $default_json = array();                                      // creez un json cu date default pt lunile anului si salariile = 0
            for ($i = 1; $i < 13; $i++) {
                $dateItem =$yearPicked . "-" . sprintf("%02d", $month);
                $jsonArrayItem = array(
                    "s_date"    =>  $dateItem,
                    "s_amount"  =>  0
                );
                /*$jsonArrayItem['s_date']    = $dateItem;
                $jsonArrayItem['s_amount']  = 10000;*/                        // Am nevoie sa fie caracter ? "0"
                array_push($default_json, $jsonArrayItem);
                $month++;
            }

            $jsonArray = array();


            if ($select->num_rows() > 0) {
                foreach ($select->result_array() as $row) {
                    $jsonArrayItem = array();
                    //$jsonArrayItem['payment_id'] = $row['payment_id'];
                    $jsonArrayItem['s_date']    = $row['s_date'];
                    $jsonArrayItem['s_amount']  = $row['s_amount'];
                    //append the above created object into the main array.
                    array_push($jsonArray, $jsonArrayItem);
                    for ($i = 0; $i < 12; ++$i) {
                        if($default_json[$i]['s_date']==$row['s_date']) {
                            $default_json[$i]['s_amount'] = $row['s_amount'];
                        }
                    }
                }
            }



            function cmp($a, $b)
            {
                return strcmp($a["s_date"], $b["s_date"]);
            }
            usort($jsonArray,"cmp");


           /*
           foreach ($jsonArray as $row) {
                foreach ($default_json as $row2) {
                    if($row["s_date"]==$row2["s_date"]){
                        $row["s_amount"] = $row2["s_amount"];
                    }
                }
            }
            */



            $default_json   = json_encode($default_json);
            $jsonArray      = json_encode($jsonArray);
            //$jsonArray=array_sort($jsonArray, 's_date', SORT_ASC);



           /* for ($i = 0; $i < 13; ++$i) {
                for ($j = 0; $j < $select->num_rows(); ++$j) {
                    if($default_json[i]['s_date']==$jsonArray[j]['s_date']) {
                        $default_json[i]['s_amount'] = $jsonArray[j]['s_amount'];
                    }
                }
            }*/



            $response = array(
                "success" => true, // e o cheie de tip string success
                "data" => $salaries_json
            );


        } catch (Exception $e) {
            $response = array(
                "success" => false//, // e o cheie de tip string success
                //"msg" => $e->getMessage() // preiau mesajul "umpleti campul"
            );
        }
        echo json_encode($response);
    }



    function downloadPDF(){

        /*
        $content='';
        $content.=  '
        <div>
                            <h2>Hello,Horia</h2>
                            <p>Thank you for joining our team, everything is almost set up.</p>
                            <p>You can login with the following credentials after you have activated your account by pressing the url below.</p>
                            
                            <p>Activation URL: </p>
                            <p><i>Random Link</i></p>
        </div>
                    ';
        $pdf->AddPage();*/



        $this->load->library('Pdf');

        $pdf = new Pdf();
        $pdf->SetTitle('Pay Slip');
        $pdf->SetHeaderMargin(30);
        $pdf->SetTopMargin(0);
        $pdf->setFooterMargin(20);
        $pdf->SetAutoPageBreak(true);
        $pdf->SetAuthor('UpWeGo');
        $pdf->SetDisplayMode('real', 'default');

        $pdf->AddPage();

        if ($this->session->userdata('logged_in') && !$this->session->userdata('logged_in')['isAdmin']) //// dar in teorie nu am nevoie decat de username ca sa il afisez pe undeva :) Majoritatea lor sunt doar pentru testare
        {

            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $data['password'] = $session_data['password'];  // doar pentru testare
            $data['email'] = $session_data['email'];          // doar pentru testare

            $data['isAdmin'] = $session_data['isAdmin'];    // doar pentru testare
            $data['logged_in'] = $session_data['logged_in'];
            //$this->load->view('ListUsers',$data);
        } else {
            //If no session, redirect to login page
            redirect('welcome', 'refresh');
        }
        $this->load->database();


        //$password = $this->input->post('password');

        $this->db->select("firstname,lastname,id");
        $this->db->where('username=', $data['username']);
        $select = $this->db->get("user");

        $firstname      = $select->result_array()[0]['firstname'];
        $lastname       = $select->result_array()[0]['lastname'];
        $id_employee    = $select->result_array()[0]['id'];
        $year= $this->input->get('yearPicker');
        $month= $this->input->get('month');
        $months=array("Ianuarie", "Februarie", "Martie", "Aprilie", "Mai", "Iunie", "Iulie", "August","Septembrie","Octombrie","Noiembrie","Decembrie");
        for($i=0; $i<12;++$i){
            if($months[$i]==$month){
                $date=sprintf("%s-%02d", $year, $i+1);
                break;
            }
        }
        $this->db->select("*");
        $this->db->where("id_employee=", $id_employee);
        $this->db->where("s_date=", $date);
        $select = $this->db->get("salary");

        $salary=$select->result_array()[0]['s_amount'];
        $cas    =   round($salary*0.105,0,PHP_ROUND_HALF_UP);
        $somaj  =   round($salary*0.005,0,PHP_ROUND_HALF_UP);
        $cass   =   round($salary*0.055,0,PHP_ROUND_HALF_UP);
        $venit_imp =round($salary-$cas-$somaj-$cass+200+100,0,PHP_ROUND_HALF_UP);  // tichete masa + transport
        $impozit=   round($venit_imp*0.16,0,PHP_ROUND_HALF_UP);
        $net    =   $salary-$cas-$somaj-$cass-$impozit;

        $filename=$data['username']."_".$year.$month.".pdf";



        // set text shadow effect
                //$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

        // Set some content to print
        $html = <<<EOD
        <body>
<div id="container-parent" style="font-family: 'Muli', sans-serif; background-color: #7f7f7f;">
    <div id="container" style="border:2px solid #000000; background-color:#D8D8D8;">
        <div>
            <div class="h1" style="font-size: 35px; text-align: center; font-weight: bolder;">UpWeGo</div>
            <table style="width:100%;">
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
                        <span><b>Nume si Prenume:</b> $lastname $firstname</span><br>
                        <span><b>Anul si luna:</b></span> $year $month<br>
                    </td>
                    <td style="width:20%;"></td>
                    <td  style="width:28%;"><img id="logo" width="120px" height="120px;" src="http://gorillaz/UpWeGo/upload/UpWeGo_Logo.png" />
                    </td>
                </tr>
            </table>
        </div><br>
        <table>
            <tr>
                <td width="9%"></td>
                <td width="81%">
                    <table border="1">
                        <tr>
                            <th colspan="3" style="text-align:center; background-color: #9d9d9d;"><b>Salariu de plata</b></th>
                        </tr>
                        <tr style="background-color: #BEBEBE;">
                            <td><b> Salariu de baza</b></td>
                            <td> </td>
                            <td style="text-align:right;"><b>$salary RON(+)</b></td>
                        </tr>
                        <tr>
                            <td> Nr. tichete de masa</td>
                            <td> </td>
                            <td style="text-align:right;">20</td>
                        </tr>
                        <tr>
                            <td> Val. tichete de masa</td>
                            <td> </td>
                            <td style="text-align:right;">200 RON</td>
                        </tr>
                        <tr>
                            <td> Decontare transport</td>
                            <td> </td>
                            <td style="text-align:right;">100 RON</td>
                        </tr>
                        <tr>
                            <td> Contributie C.A.S. </td>
                            <td style="text-align:right;">10.5%</td>
                            <td style="text-align:right;"> $cas RON(-)</td>
                        </tr>
                        <tr>
                            <td> Contributie ajutor somaj </td>
                            <td style="text-align:right;">0.5%</td>
                            <td style="text-align:right;"> $somaj RON(-)</td>
                        </tr>
                        <tr>
                            <td> Contributie C.A.S.S. </td>
                            <td style="text-align:right;">5.5%</td>
                            <td style="text-align:right;"> $cass RON(-)</td>
                        </tr>
                        <tr>
                            <td> Baza imp. tichete masa </td>
                            <td style="text-align:right;"></td>
                            <td style="text-align:right;">200 RON</td>
                        </tr>
                        <tr>
                            <td> Baza imp. decont. transp. </td>
                            <td style="text-align:right;"></td>
                            <td style="text-align:right;">100 RON</td>
                        </tr>
                        <tr style="background-color: #BEBEBE;">
                            <td><b> Venit baza calc. impoz.</b></td>
                            <td> </td>
                            <td style="text-align:right;"><b> $venit_imp RON</b></td>
                        </tr>
                        <tr>
                            <td> Impozit</td>
                            <td style="text-align:right;">16%</td>
                            <td style="text-align:right;"> $impozit RON(-)</td>
                        </tr>
                        <tr style="background-color: #BEBEBE;">
                            <td><b> Salariu net</b></td>
                            <td></td>
                            <td style="text-align:right;"><b> $net RON</b></td>
                        </tr>
                    </table>
                </td>
                <td width="9%"></td>
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
EOD;

        //$html= file_get_contents("application/views/flyer.php");
        
        // Print text using writeHTMLCell()
        //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        //$pdf->writeHTML($html);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output($filename, 'I');
        //echo var_dump($pdf);

    }


}
